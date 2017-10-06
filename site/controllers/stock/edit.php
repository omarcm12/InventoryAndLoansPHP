<?php /* controllers/admin/tags/edit */

// if ($BASE->Session()->LoggedOut()) {
//   $BASE->Response()->RedirectAndExit('/admin/login');
// }

$material = FetchMaterialWithID($BASE->RouteParam(0));
if (empty($material)) {
  $BASE->Response()->ExitWithNotFound('Material not found.', 'Material: ' . $BASE->RouteParam(0));
}

$BASE->Response()->Render($BASE->Template(), ['material' => $material]);

?>
