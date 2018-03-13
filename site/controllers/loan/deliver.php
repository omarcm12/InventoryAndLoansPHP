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
		
		$entrega = FetchAgeCaduce($material->Days());
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

$loan->deliver_at = strftime($format, $timestamp = time());  
$now = time();
$ageunix = mktime(0,0,0,date("m",$now), date("d",$now), date("Y",$now));
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
