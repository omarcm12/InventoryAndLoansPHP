<?php
if ($BASE->Session()->LoggedOut()) {
  $BASE->Response()->RedirectAndExit('/', BASE_RESPONSE_REDIRECT_OTHER);
}else if(!adminCurrentUser()->IsStudent()) {
	$BASE->Response()->ExitWithNotFound('Pagina no encontrada', '');
}

$materials = FetchAllMaterials($BASE->GetParam('page'), 20, $BASE->GetParam('s'));
$materials->SetResultsTotal(MaterialsCount());

$vars = [
	'materials' => $materials,
	'search_default_value' => $BASE->GetParam('s')
];
$BASE->Response()->Render($BASE->Template(), $vars);

?>