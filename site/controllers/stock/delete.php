<?php /* controllers/admin/categories/delete */

// if ($BASE->Session()->LoggedOut()) {
//   $BASE->Response()->RedirectAndExit('/admin/login', BASE_RESPONSE_REDIRECT_OTHER);
// }
// if (!adminCurrentAuthor()->IsAdmin()) {
//   $BASE->Response()->RedirectAndExit('/admin/', BASE_RESPONSE_REDIRECT_OTHER);
// }

$material = FetchMaterialWithId($BASE->RouteParam(0));
if (empty($material)) {
  $BASE->Response()->ExitWithNotFound('Material not found.', 'Material: ' . $BASE->RouteParam(0));
}

if ($material->Destroy()) {
  $BASE->Session()->SetFlash(['success' => 'Material eliminado.']);
} else {
  $BASE->Session()->SetFlash(['danger' => 'Error eliminando Material.']);
}

$BASE->Response()->RedirectAndExit('/inventario', BASE_RESPONSE_REDIRECT_OTHER);

?>