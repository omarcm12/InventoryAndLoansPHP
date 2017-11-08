<?php /* controllers/admin/transactions/create */

if ($BASE->Session()->LoggedOut()) {
  $BASE->Response()->RedirectAndExit('/', BASE_RESPONSE_REDIRECT_OTHER);
}

$move = new Move();

$postParams = $BASE->PostParam('move');
if (empty($postParams)) { $postParams = []; }

$move->id_material = $postParams['id_material'];
$move->catalog_number_material = $postParams['catalog_number_material'];
//$move->id_user = $postParams['id_user'];
$move->type = $postParams['type'];
$move->no_order = $postParams['no_order'];
$move->description = $postParams['description'];

if ($move->Valid() && $move->Create()) {			

	$BASE->Session()->SetFlash(['success' => 'Movimiento Registrado.']);
	$BASE->Response()->RedirectAndExit('/admin/inventario/', BASE_RESPONSE_REDIRECT_OTHER);
}

$BASE->Session()->SetFlash(['danger' => 'Error guardando el movimiento.']);
$BASE->Response()->RedirectAndExit('/admin/inventario', BASE_RESPONSE_REDIRECT_OTHER);

?>
