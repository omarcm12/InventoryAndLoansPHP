<?php /* controllers/admin/transactions/create */

/*if ($BASE->Session()->LoggedOut()) {
  $BASE->Response()->RedirectAndExit('/admin/login', BASE_RESPONSE_REDIRECT_OTHER);
}
if (!adminCurrentAuthor()->IsAdmin()) {
  $BASE->Response()->RedirectAndExit('/admin/', BASE_RESPONSE_REDIRECT_OTHER);
}*/

$material = new Material();

$postParams = $BASE->PostParam('material');
if (empty($postParams)) { $postParams = []; }

$material->name = $postParams['name'];
$material->description = $postParams['description'];
$material->total_count = $postParams['total_count'];

if ($material->Valid() && $material->Create()) {			
  	$BASE->Session()->SetFlash(['success' => 'Material created.']);
  	$BASE->Response()->RedirectAndExit('/inventario/', BASE_RESPONSE_REDIRECT_OTHER);
}

$BASE->Session()->SetFlash(['danger' => 'Error guardando el material.']);
$BASE->Response()->RedirectAndExit('/inventario/nuevo', BASE_RESPONSE_REDIRECT_OTHER);

?>
