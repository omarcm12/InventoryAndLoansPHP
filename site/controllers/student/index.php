<?php

if ($BASE->Session()->LoggedOut()) {
  $BASE->Response()->RedirectAndExit('/', BASE_RESPONSE_REDIRECT_OTHER);
}else if(!adminCurrentUser()->IsAdmin()) {
	$BASE->Response()->ExitWithNotFound('Pagina no encontrada', '');
}

$item_per_page = 50;
$complete_list = FetchAllStudents(1, 10000, $BASE->GetParam('s'));
$total_items = count($complete_list);
$students = FetchAllStudents($BASE->GetParam('page'), $item_per_page, $BASE->GetParam('s'));
$students->SetResultsTotal(UsersCount());

$vars = [
	'students' => $students,
	'total_items' => $total_items,
	'item_per_page' => $item_per_page,
	'search_default_value' => $BASE->GetParam('s')
];


$BASE->Response()->Render($BASE->Template(), $vars);

?>