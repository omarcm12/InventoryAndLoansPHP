<?php /* controllers/admin/tags/edit */

if ($BASE->Session()->LoggedOut()) {
  $BASE->Response()->RedirectAndExit('/', BASE_RESPONSE_REDIRECT_OTHER);
}else if(!adminCurrentUser()->IsAdmin()) {
	$BASE->Response()->ExitWithNotFound('Pagina no encontrada', '');
}

$material = FetchMaterialWithID($BASE->RouteParam(0));
if (empty($material)) {
  $BASE->Response()->ExitWithNotFound('Material not found.', 'Material: ' . $BASE->RouteParam(0));
}

$BASE->Response()->Render($BASE->Template(), [
	'material' => $material,
	'is_edit' => true
	]);

?>
