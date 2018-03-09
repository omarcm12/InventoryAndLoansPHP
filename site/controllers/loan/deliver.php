<?php


if ($BASE->Session()->LoggedOut()) {
  $BASE->Response()->RedirectAndExit('/', BASE_RESPONSE_REDIRECT_OTHER);
}else if(!adminCurrentUser()->IsAdmin()) {
	$BASE->Response()->ExitWithNotFound('Pagina no encontrada', '');
}

$loan = FetchLoanWithID($BASE->RouteParam(0));
if (empty($loan)) {
  $BASE->Response()->ExitWithNotFound('Prestamo no encontrado.', 'Prestamo: ' . $BASE->RouteParam(0));
}

foreach ($loan->LoanMaterials() as $loan_material){
	$send_loan_material = $_POST["loan-material"][$loan_material->ID()];
	if($send_loan_material["amount"] == 0 || $send_loan_material["deliver"] == 0){
		$loan_material->Destroy();
	}else{
		$material = FetchMaterialWithID($loan_material->Material()->ID());
		$format = BASE_SIMPLE_DATE_FORMAT;
		$loan_material->deliver_at = strftime($format, $timestamp = time());
		//$entrega = mktime(0, 0, 0, date("m")  , date("d")+$material->Days(), date("Y"));
		$entrega = FetchAgeCaduce($material->Days());//time() + ($material->Days() * 24 * 60 * 60); 
		$loan_material->return_at = strftime($format,$entrega);
		$loan_material->amount = $send_loan_material["amount"];
		$loan_material->description = $send_loan_material["description"];
		$loan_material->Update();

		
		$material->borrowed_count += $loan_material->Amount(); 
		$material->Update();
	}
}

$loan->status = LOAN_STATUS_IN_PROGRESS;
$format = BASE_SIMPLE_DATE_FORMAT;
/*
$loan->deliver_at = strtotime($loan->deliver_at);*/
$loan->deliver_at = strftime($format, $timestamp = time());
/*$mañana  = mktime(date("Y")  ,date("m"), date("d")+3);

$entrega = time() + (3*24*60*60);

$loan->return_at = strftime($format,$entrega);*/

$tiempo = time();

$prueba = date("Y-m-d",$tiempo);
/*$prueba = "-" . date("m",$tiempo);
$prueba = "-" . date("d",$tiempo);*/

$ageunix = mktime(0,0,0,date("m",$tiempo), date("d",$tiempo), date("Y",$tiempo));

//$otra = strtotime("Y-m-d",$prueba);
$entrega = $ageunix + (3*24*60*60);
$loan->return_at = strftime($format,$entrega);


if($loan->Update()){
	$BASE->Session()->SetFlash(['success' => 'Prestamo entregado.']);
	$BASE->Response()->RedirectAndExit('/admin/prestamos', BASE_RESPONSE_REDIRECT_OTHER);
}else{
	$BASE->Session()->SetFlash(['danger' => 'Error agregando material al prestamo.']);
	$BASE->Response()->RedirectAndExit('/admin/prestamos', BASE_RESPONSE_REDIRECT_OTHER);
}

?>
