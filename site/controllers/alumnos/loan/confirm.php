<?php /* controllers/admin/categories/delete */

if ($BASE->Session()->LoggedOut()) {
  $BASE->Response()->RedirectAndExit('/', BASE_RESPONSE_REDIRECT_OTHER);
}else if(!adminCurrentUser()->IsStudent()) {
	$BASE->Response()->ExitWithNotFound('Pagina no encontrada', '');
}

$loan = FetchLoanWithID($BASE->RouteParam(0));
if (empty($loan)) {
  $BASE->Response()->ExitWithNotFound('Prestamo no encontrado.', 'Prestamo: ' . $BASE->RouteParam(0));
}

$loan->status = LOAN_STATUS_WAITING;

if (!$loan->Update()) {
  $BASE->Session()->SetFlash(['danger' => 'Error eliminando Material.']);
}else{
	$BASE->Session()->SetFlash(['success' => 'Prestamo Creado.']);
}

$BASE->Response()->RedirectAndExit('/alumnos/prestamos', BASE_RESPONSE_REDIRECT_OTHER);

?>
