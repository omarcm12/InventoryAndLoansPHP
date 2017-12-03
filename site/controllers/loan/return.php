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
	$returned = $send_loan_material["amount"];
	if($returned > $loan_material->Amount()){
		$returned = $loan_material->Amount();
	}else if($loan_material->Amount() < 0){
		$returned = 0;
	}
	$loan_material->returned_amount = $returned;
	$loan_material->Update();
}

$loan->status = LOAN_STATUS_ENDED;

if($loan->Update()){
	$BASE->Session()->SetFlash(['success' => 'Prestamo actualizado.']);
	$BASE->Response()->RedirectAndExit('/admin/prestamos?f=3', BASE_RESPONSE_REDIRECT_OTHER);
}else{
	$BASE->Session()->SetFlash(['danger' => 'Error al finalizar prestamo.']);
	$BASE->Response()->RedirectAndExit('/admin/prestamos', BASE_RESPONSE_REDIRECT_OTHER);
}

?>