<?php
if ($BASE->Session()->LoggedOut()) {
  $BASE->Response()->RedirectAndExit('/', BASE_RESPONSE_REDIRECT_OTHER);
}else if(!adminCurrentUser()->IsStudent()) {
	$BASE->Response()->ExitWithNotFound('Pagina no encontrada', '');
}else if (adminCurrentUser()->Status() == STUDENT_PENDING){
	$BASE->Response()->RedirectAndExit('/post-registro/', BASE_RESPONSE_REDIRECT_OTHER);
}

//$loans = FetchLoansWithStudentId(adminCurrentUser()->ID());

$filter = $BASE->GetParam('f');
if(empty($filter)) $filter = 1;

$loans = FetchLoansWithStudentId($BASE->GetParam('page'), 20, $BASE->GetParam('s'), $filter, adminCurrentUser()->ID());
$loans->SetResultsTotal(LoansCount());
$student = FetchUserWithID(adminCurrentUser()->ID()); 

$vars = [
	'loans' => $loans,
	'search_default_value' => $BASE->GetParam('s'),
	'filter' => $filter,
	'student' => $student
];

$BASE->Response()->Render($BASE->Template(), $vars);

?>