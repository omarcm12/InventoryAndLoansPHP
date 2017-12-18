<?php
if ($BASE->Session()->LoggedOut()) {
  $BASE->Response()->RedirectAndExit('/', BASE_RESPONSE_REDIRECT_OTHER);
}else if(!adminCurrentUser()->IsStudent()) {
	$BASE->Response()->ExitWithNotFound('Pagina no encontrada', '');
}

$user = FetchUserWithID(adminCurrentUser()->ID());
$loads = FetchLoansWithStudentId(adminCurrentUser()->ID());
$vars = [
	'user' => $user,
	'loads' => $loads
];


$BASE->Response()->Render($BASE->Template(), $vars);

?>