<?php

if ($BASE->Session()->LoggedOut()) {
  $BASE->Response()->RedirectAndExit('/', BASE_RESPONSE_REDIRECT_OTHER);
}else if(!adminCurrentUser()->IsAdmin()) {
	$BASE->Response()->ExitWithNotFound('Pagina no encontrada', '');
}

$item_per_page = 5;
$complete_list = FetchAllPayments(1, 10000, $BASE->GetParam('s'), $BASE->GetParam('o'));
$total_items = count($complete_list);
$payments = FetchAllPayments($BASE->GetParam('page'), $item_per_page, $BASE->GetParam('s'), $BASE->GetParam('o'));
$payments->SetResultsTotal(PaymentsCount());
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