<?php /* controllers/admin/transactions/create */

if ($BASE->Session()->LoggedOut()) {
  $BASE->Response()->RedirectAndExit('/', BASE_RESPONSE_REDIRECT_OTHER);
}

$move = new Move();

$postParams = $BASE->PostParam('move');
if (empty($postParams)) { $postParams = []; }

//$move->id_material = $postParams['id_material'];
// $move->catalog_number_material = $postParams['catalog_number_material'];
// $move->id_user = adminCurrentUser()->ID();
// $move->type = $postParams['type'];
// $move->no_order = $postParams['no_order'];
// $move->description = $postParams['description'];

//if (!$move->Valid()) {
  $BASE->Response()->RenderJSON(['result' => 'Error, por favor revisa la información']);
  exit();
//}

if (!$move->Create()) {
  $BASE->Response()->RenderJSON(['result' => 'Error al crear movimiento, intentalo mas tarde.']);
  exit();
}


$BASE->Response()->RenderJSON(['result' => 'OK']);
?>
