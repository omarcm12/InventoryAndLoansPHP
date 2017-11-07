<?php

if ($BASE->Session()->LoggedOut()) {
  $BASE->Response()->RedirectAndExit('/', BASE_RESPONSE_REDIRECT_OTHER);
}

$moves = FetchAllMoves($BASE->GetParam('page'), 20, $BASE->GetParam('s'));
$moves->SetResultsTotal(MovesCount());

$vars = [
	'moves' => $moves,
	'search_default_value' => $BASE->GetParam('s')
];

$BASE->Response()->Render($BASE->Template(), $vars);

?>