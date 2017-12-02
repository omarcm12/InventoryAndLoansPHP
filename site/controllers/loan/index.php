<?php

if ($BASE->Session()->LoggedOut()) {
  $BASE->Response()->RedirectAndExit('/', BASE_RESPONSE_REDIRECT_OTHER);
}else if(!adminCurrentUser()->IsAdmin()) {
	$BASE->Response()->ExitWithNotFound('Pagina no encontrada', '');
}

$filter = $BASE->GetParam('f');
if(empty($filter)) $filter = 1;

$loans = FetchAllLoans($BASE->GetParam('page'), 20, $BASE->GetParam('s'), $filter);
$loans->SetResultsTotal(LoansCount());

$vars = [
	'loans' => $loans,
	'search_default_value' => $BASE->GetParam('s'),
	'filter' => $filter
];

$BASE->Response()->Render($BASE->Template(), $vars);

?>