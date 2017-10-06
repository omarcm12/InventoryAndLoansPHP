<?php /* controllers/admin/tags/update */

// if ($BASE->Session()->LoggedOut()) {
//   $BASE->Response()->RedirectAndExit('/admin/login', BASE_RESPONSE_REDIRECT_OTHER);
// }

$material = FetchMaterialWithID($BASE->RouteParam(0));
if (empty($material)) {
  $BASE->Response()->ExitWithNotFound('Material not found.', 'Material: ' . $BASE->RouteParam(0));
}

$postParams = $BASE->PostParam('material');
if (empty($postParams)) { $postParams = []; }

$material->name = $postParams['name'];
$material->description = $postParams['description'];
$material->total_count = $postParams['total_count'];
$material->catalog_number = $postParams['catalog_number'];
$material->price_per_unit = $postParams['price_per_unit'] * 100;

if ($material->Valid() && $material->Update()) {
  $BASE->Session()->SetFlash(['success' => 'Material actualizado.']);
} else {
  $BASE->Session()->SetFlash(['danger' => 'Error actualizando Material.']);
}

$BASE->Response()->RedirectAndExit('/inventario/' . $material->ID(), BASE_RESPONSE_REDIRECT_OTHER);

?>
