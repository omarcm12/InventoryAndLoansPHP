<?php

if ($BASE->Session()->LoggedOut()) {
  $BASE->Response()->RedirectAndExit('/', BASE_RESPONSE_REDIRECT_OTHER);
}

$loans = FetchAllLoans($BASE->GetParam('page'), 20, $BASE->GetParam('s'));
$loans->SetResultsTotal(LoansCount());

$vars = [
	'loans' => $loans,
	'search_default_value' => $BASE->GetParam('s')
];

$BASE->Response()->Render($BASE->Template(), $vars);

?>