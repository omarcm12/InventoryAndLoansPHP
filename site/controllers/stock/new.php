<?php


$vars = [
	'material' => new Material()
];

$BASE->Response()->Render($BASE->Template(), $vars);

?>