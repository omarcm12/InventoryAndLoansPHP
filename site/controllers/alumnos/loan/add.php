<?php /* controllers/admin/transactions/create */

if ($BASE->Session()->LoggedOut()) {
  $BASE->Response()->RedirectAndExit('/', BASE_RESPONSE_REDIRECT_OTHER);
}else if(!adminCurrentUser()->IsStudent()) {
  $BASE->Response()->ExitWithNotFound('Pagina no encontrada', '');
}

$loan_material = new LoanMaterial();

$postParams = $BASE->PostParam('loan_material');
if (empty($postParams)) { $postParams = []; }

$loan_material->id_loan = $postParams['id-loan'];
$loan_material->id_material = $postParams['id-material'];
$loan_material->amount = $postParams['amount'];

if ($loan_material->Valid() && $loan_material->Create()) {      
  $BASE->Response()->RedirectAndExit('/alumnos/prestamos/', BASE_RESPONSE_REDIRECT_OTHER);
}

$BASE->Session()->SetFlash(['danger' => 'Error agregando material al prestamo.']);
$BASE->Response()->RedirectAndExit('/alumnos/inventario', BASE_RESPONSE_REDIRECT_OTHER);

?>
