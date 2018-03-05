<?php

if ($BASE->Session()->LoggedOut()) {
  $BASE->Response()->RedirectAndExit('/', BASE_RESPONSE_REDIRECT_OTHER);
}else if(!adminCurrentUser()->IsAdmin()) {
	$BASE->Response()->ExitWithNotFound('Pagina no encontrada', '');
}

$penaltys = FetchAllPenaltys($BASE->GetParam('page'), 20, $BASE->GetParam('s'), $BASE->GetParam('o'));
$penaltys->SetResultsTotal(PenaltysCount());
//ReportAllMaterials();
$sort_code = $BASE->GetParam('o');
$vars = [
	'penaltys' => $penaltys,
	'search_default_value' => $BASE->GetParam('s')
];

$BASE->Response()->Render($BASE->Template(), $vars);

?>