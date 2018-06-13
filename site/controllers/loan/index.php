			<?php

if ($BASE->Session()->LoggedOut()) {
  $BASE->Response()->RedirectAndExit('/', BASE_RESPONSE_REDIRECT_OTHER);
}else if(!adminCurrentUser()->IsAdmin()) {
	$BASE->Response()->ExitWithNotFound('Pagina no encontrada', '');
}

$filter = $BASE->GetParam('f');
if(empty($filter)) $filter = 1;
$configuration = FetchConfiguration();

$item_per_page = 50;
$complete_list = FetchAllLoans(1, 10000, $BASE->GetParam('s'), $filter);
$total_items = count($complete_list);
$loans = FetchAllLoans($BASE->GetParam('page'), $item_per_page, $BASE->GetParam('s'), $filter);
$status = $filter;
foreach ($loans as $loan) {
	if($loan->Status() == 1){//request loans
		if(DaysCount(strtotime($loan->RequestAt())) > $configuration->DaysExpiredLoan()){
			$loan->Destroy();
		}
	}
}
$loans->SetResultsTotal(LoansCount());

$vars = [
	'loans' => $loans,
	'item_per_page' => $item_per_page,
	'total_items' => $total_items,
	'search_default_value' => $BASE->GetParam('s'),
	'filter' => $filter
];

$BASE->Response()->Render($BASE->Template(), $vars);

?>