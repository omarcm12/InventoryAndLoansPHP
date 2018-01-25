<?php
if ($BASE->Session()->LoggedOut()) {
  $BASE->Response()->RedirectAndExit('/', BASE_RESPONSE_REDIRECT_OTHER);
}else if(!adminCurrentUser()->IsStudent()) {
	$BASE->Response()->ExitWithNotFound('Pagina no encontrada', '');
}

$loan = FetchLoanWithID($BASE->RouteParam(0));
if (empty($loan)) {
  $BASE->Response()->ExitWithNotFound('Loan not found.', 'Loan: ' . $BASE->RouteParam(0));
}

if ($loan->Destroy()) {
  $BASE->Session()->SetFlash(['success' => 'Solicitud eliminada.']);
} else {
  $BASE->Session()->SetFlash(['danger' => 'Error eliminando Solicitud.']);
}

$BASE->Response()->RedirectAndExit('/alumnos/historial', BASE_RESPONSE_REDIRECT_OTHER);

?>