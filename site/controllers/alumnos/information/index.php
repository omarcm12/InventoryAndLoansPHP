<?php
if ($BASE->Session()->LoggedOut()) {
  $BASE->Response()->RedirectAndExit('/', BASE_RESPONSE_REDIRECT_OTHER);
}else if(!adminCurrentUser()->IsStudent()) {
	$BASE->Response()->ExitWithNotFound('Pagina no encontrada', '');
}

$student = FetchStudentWithID(adminCurrentUser()->ID());


$vars = [
	'student' => $student
];


$BASE->Response()->Render($BASE->Template(), $vars);

?>