<?php
if ($BASE->Session()->LoggedOut()) {
  $BASE->Response()->RedirectAndExit('/', BASE_RESPONSE_REDIRECT_OTHER);
}else if(!adminCurrentUser()->IsStudent()) {
	$BASE->Response()->ExitWithNotFound('Pagina no encontrada', '');
}
/*
$loans = FetchAllLoans($BASE->GetParam('page'), 20, $BASE->GetParam('s'), $BASE->GetParam('o'));
$loans->SetResultsTotal(LoansCount());

$sort_code = $BASE->GetParam('o');
$vars = [
	'loans' => $loans,
	'search_default_value' => $BASE->GetParam('s'),
	'sort_id' => (int)($sort_code >> 1 & 0x3),
	'sort_type' => (int)$sort_code & 0x1
];*/


$BASE->Response()->Render($BASE->Template(), $vars);

?>