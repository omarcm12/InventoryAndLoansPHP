<?php /* controllers/admin/categories/delete */

if ($BASE->Session()->LoggedOut()) {
  $BASE->Response()->RedirectAndExit('/', BASE_RESPONSE_REDIRECT_OTHER);
}else if(!adminCurrentUser()->IsStudent()) {
	$BASE->Response()->ExitWithNotFound('Pagina no encontrada', '');
}else if (adminCurrentUser()->Status() == STUDENT_PENDING){
	$BASE->Response()->RedirectAndExit('/post-registro/', BASE_RESPONSE_REDIRECT_OTHER);
}

$loan = FetchLoanWithID($BASE->RouteParam(0));
if (empty($loan)) {
  $BASE->Response()->ExitWithNotFound('Prestamo no encontrado.', 'Prestamo: ' . $BASE->RouteParam(0));
}

foreach ($loan->LoanMaterials() as $loan_material){
	$send_loan_material = $_POST["loan-material"][$loan_material->ID()];
	if($send_loan_material["amount"] == 0){
		$loan_material->Destroy();
	}else{
		$loan_material->amount = $send_loan_material["amount"];
		//$loan_material->return_unix = 0;
		$loan_material->Update();
	}
}
$format = BASE_SIMPLE_DATE_FORMAT;
//$loan->request_at = strftime($format, mktime (date("H") ,date("i") ,date("s") , date("n"),date("j"),2018,-1 ));
$loan->request_at = date(("Y-m-d H:m:s"), time());
$loan->status = LOAN_STATUS_WAITING;

if (!$loan->Update()) {
  $BASE->Session()->SetFlash(['danger' => 'Error eliminando Material.']);
}else{
	$configuration = FetchConfiguration();
	$BASE->Session()->SetFlash(['success' => 'Solicitud de prestamo creada correctamente - Su solicitud EXPIRA en ' . $configuration->DaysExpiredLoan() . ' dias.']);
}

$BASE->Response()->RedirectAndExit('/alumnos/prestamos', BASE_RESPONSE_REDIRECT_OTHER);

?>
