<?php

if ($BASE->Session()->LoggedOut()) {
  $BASE->Response()->RedirectAndExit('/', BASE_RESPONSE_REDIRECT_OTHER);
}else if(!adminCurrentUser()->IsService()) {
	$BASE->Response()->ExitWithNotFound('Pagina no encontrada', '');
}

$loan = FetchLoanWithID($BASE->RouteParam(0));
if (empty($loan)) {
  $BASE->Response()->ExitWithNotFound('Loan not found.', 'Loan: ' . $BASE->RouteParam(0));
}

if (!$loan->Destroy()) {
  $BASE->Session()->SetFlash(['danger' => 'Error eliminando Loan.']);
}
else{
	$BASE->Session()->SetFlash(['success' => 'Solicitud eliminada.']);
}

$BASE->Response()->RedirectAndExit('/servicio/prestamos', BASE_RESPONSE_REDIRECT_OTHER);;

?>