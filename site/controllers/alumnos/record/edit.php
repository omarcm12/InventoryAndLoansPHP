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

DeleteLoanForEdit(adminCurrentUser()->ID());
UpdateLoanForEdit($loan->ID());


$BASE->Response()->RedirectAndExit('/alumnos/prestamos', BASE_RESPONSE_REDIRECT_OTHER);

?>