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

$item_per_page = 50;
$complete_list = FetchLoansWithStudentId(1, 10000, $BASE->GetParam('s'), $filter, adminCurrentUser()->ID());
$total_items = count($complete_list);
$loans = FetchLoansWithStudentId($BASE->GetParam('page'), $item_per_page, $BASE->GetParam('s'), $filter, adminCurrentUser()->ID());
$loans->SetResultsTotal(LoansCount());
$student = FetchUserWithID(adminCurrentUser()->ID()); 

$vars = [
	'loans' => $loans,
	'search_default_value' => $BASE->GetParam('s'),
	'item_per_page' => $item_per_page,
	'total_items' => $total_items,
	'filter' => $filter,
	'student' => $student
];

$BASE->Response()->Render($BASE->Template(), $vars);

?>