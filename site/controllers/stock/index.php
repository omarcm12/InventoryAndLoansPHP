<?php


$materials = FetchAllMaterials($BASE->GetParam('page'), 20);
$materials->SetResultsTotal(MaterialsCount());

$vars = [
	'materials' => $materials
];

$BASE->Response()->Render($BASE->Template(), $vars);

?>