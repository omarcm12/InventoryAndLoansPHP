<?php

if ($BASE->Session()->LoggedOut()) {
  $BASE->Response()->RedirectAndExit('/', BASE_RESPONSE_REDIRECT_OTHER);
}else if(!adminCurrentUser()->IsService()) {
	$BASE->Response()->ExitWithNotFound('Pagina no encontrada', '');
}

$students = FetchAllStudents($BASE->GetParam('page'), 20, $BASE->GetParam('s'));
$students->SetResultsTotal(UsersCount());

$vars = [
	'students' => $students,
	'search_default_value' => $BASE->GetParam('s')
];


$BASE->Response()->Render($BASE->Template(), $vars);

?>