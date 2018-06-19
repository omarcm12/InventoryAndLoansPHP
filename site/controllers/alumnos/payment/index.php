<?php
if ($BASE->Session()->LoggedOut()) {
  $BASE->Response()->RedirectAndExit('/', BASE_RESPONSE_REDIRECT_OTHER);
}else if(!adminCurrentUser()->IsStudent()) {
	$BASE->Response()->ExitWithNotFound('Pagina no encontrada', '');
}else if (adminCurrentUser()->Status() == STUDENT_PENDING){
	$BASE->Response()->RedirectAndExit('/post-registro/', BASE_RESPONSE_REDIRECT_OTHER);
}

$item_per_page = 5;
$complete_list = FetchPaymentsWithIDStudent(1, 10000, $BASE->GetParam('s'), $BASE->GetParam('o'), adminCurrentUser()->ID());
$total_items = count($complete_list);
$payments = FetchPaymentsWithIDStudent($BASE->GetParam('page'), $item_per_page, $BASE->GetParam('s'), $BASE->GetParam('o'), adminCurrentUser()->ID());
$payments->SetResultsTotal(paymentsCount());
//ReportAllMaterials();
$sort_code = $BASE->GetParam('o');
$vars = [
	'payments' => $payments,
	'total_items' => $total_items,
	'item_per_page' => $item_per_page,
	'search_default_value' => $BASE->GetParam('s')
];

$BASE->Response()->Render($BASE->Template(), $vars);

?>