<?php

if ($BASE->Session()->LoggedOut()) {
  $BASE->Response()->RedirectAndExit('/', BASE_RESPONSE_REDIRECT_OTHER);
}else if(!adminCurrentUser()->IsAdmin()) {
	$BASE->Response()->ExitWithNotFound('Pagina no encontrada', '');
}

$payments = FetchAllPayments($BASE->GetParam('page'), 20, $BASE->GetParam('s'), $BASE->GetParam('o'));
$payments->SetResultsTotal(PaymentsCount());
//ReportAllMaterials();
$sort_code = $BASE->GetParam('o');
$vars = [
	'payments' => $payments,
	'search_default_value' => $BASE->GetParam('s')
];

$BASE->Response()->Render($BASE->Template(), $vars);

?>