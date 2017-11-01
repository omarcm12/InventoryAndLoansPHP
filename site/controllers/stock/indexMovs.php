<?php
$moves = FetchAllMoves($BASE->GetParam('page'), 20, $BASE->GetParam('s'));
$moves->SetResultsTotal(MovesCount());

$vars = [
	'moves' => $moves,
	'search_default_value' => $BASE->GetParam('s')
];

$BASE->Response()->Render($BASE->Template(), $vars);

?>