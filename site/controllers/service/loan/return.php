<?php

if ($BASE->Session()->LoggedOut()) {
  $BASE->Response()->RedirectAndExit('/', BASE_RESPONSE_REDIRECT_OTHER);
}else if(!adminCurrentUser()->IsService()) {
	$BASE->Response()->ExitWithNotFound('Pagina no encontrada', '');
}

$loan = FetchLoanWithID($BASE->RouteParam(0));
if (empty($loan)) {
  $BASE->Response()->ExitWithNotFound('Prestamo no encontrado.', 'Prestamo: ' . $BASE->RouteParam(0));
}
$flag = 1;

/* BITACORA */
$move_loan = new MoveLoan();
$move_loan->id_loan = $loan->ID();
$move_loan->id_student = $loan->Student()->ID();
$move_loan->id_user = adminCurrentUser()->ID();
$move_loan->type = MOVE_TYPE_RETURN;
$move_loan->Create();
/* END BITACORA */


foreach ($loan->LoanMaterials() as $loan_material){
	$send_loan_material = $_POST["loan-material"][$loan_material->ID()];
	$returned = $send_loan_material["amount"];
	$description = $send_loan_material["description"];
	if(( $returned + $loan_material->ReturnedAmount() ) > $loan_material->Amount()){
		$returned = $loan_material->Amount();
	}else if($loan_material->Amount() < 0){
		$returned = 0;
	}
	$loan_material->returned_amount += $returned;
	//$loan_material->returned_amount = $description;
	if($loan_material->ReturnedAmount() < $loan_material->Amount()){
		$flag=0;
	}
	$material = FetchMaterialWithID($loan_material->Material()->ID());
	$material->borrowed_count -= $returned;
	$material->Update();
	$loan_material->Update();

	/*   BITACORA  */
	$move_loan_material = new MoveLoanMaterial();
	$move_loan_material->id_move_loan = $move_loan->ID();
	$move_loan_material->id_material = $loan_material->Material()->ID();
	$move_loan_material->amount = $send_loan_material["amount"];
	$move_loan_material->Create();
	/*END BITACORA  */

}
if($flag){
	$loan->status = LOAN_STATUS_ENDED;	
}


if($loan->Update()){
	$BASE->Session()->SetFlash(['success' => 'Prestamo actualizado.']);
	$BASE->Response()->RedirectAndExit('/servicio/prestamos?f=3', BASE_RESPONSE_REDIRECT_OTHER);
}else{
	$BASE->Session()->SetFlash(['danger' => 'Error al finalizar prestamo.']);
	$BASE->Response()->RedirectAndExit('/servicio/prestamos', BASE_RESPONSE_REDIRECT_OTHER);
}

?>