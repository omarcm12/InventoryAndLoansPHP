<?php /* controllers/admin/transactions/create */

if ($BASE->Session()->LoggedOut()) {
  $BASE->Response()->RedirectAndExit('/', BASE_RESPONSE_REDIRECT_OTHER);
}else if(!adminCurrentUser()->IsStudent()) {
  $BASE->Response()->ExitWithNotFound('Pagina no encontrada', '');
}else if (adminCurrentUser()->Status() == STUDENT_PENDING){
	$BASE->Response()->RedirectAndExit('/post-registro/', BASE_RESPONSE_REDIRECT_OTHER);
}

$loan_material = new LoanMaterial();

$postParams = $BASE->PostParam('loan_material');
if (empty($postParams)) { $postParams = []; }

$loan_material->id_loan = $postParams['id-loan'];
$loan_material->id_material = $postParams['id-material'];
$loan_material->amount = $postParams['amount'];
$loan_material->returned_amount = 0;
$loan_material->return_unix = 0;

if($loan_material->amount < 1){
	$BASE->Session()->SetFlash(['danger' => 'Es necesario que la cantidad del producto sea al menos de 1.']);
	$BASE->Response()->RedirectAndExit('/alumnos/prestamos/', BASE_RESPONSE_REDIRECT_OTHER);
}

if ($loan_material->Valid() && $loan_material->Create()) {      
  $BASE->Response()->RedirectAndExit('/alumnos/prestamos/', BASE_RESPONSE_REDIRECT_OTHER);
}

$BASE->Session()->SetFlash(['danger' => 'Error agregando material al prestamo.']);
$BASE->Response()->RedirectAndExit('/alumnos/inventario', BASE_RESPONSE_REDIRECT_OTHER);

?>
