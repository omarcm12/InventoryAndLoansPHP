<?php /* controllers/admin/transactions/create */

if ($BASE->Session()->LoggedOut()) {
  $BASE->Response()->RedirectAndExit('/', BASE_RESPONSE_REDIRECT_OTHER);
}else if(!adminCurrentUser()->IsAdmin()) {
	$BASE->Response()->ExitWithNotFound('Pagina no encontrada', '');
}

$move = new Move();

$postParams = $BASE->PostParam('move');
if (empty($postParams)) { $postParams = []; }

$move->id_material = $postParams['id_material'];
$move->id_user = adminCurrentUser()->ID();
$move->type = $postParams['type'];
$move->no_order = $postParams['no-order'];
$move->description = $postParams['description'];
$move->pieces = $postParams['pieces'];

if (!$move->Valid()) {
  $BASE->Response()->RenderJSON([
  	'errorCode' => 1,
  	'result' => 'Error, favor de llenar todos los campos'
  	]);
  exit();
}

if (!$move->Create()) {
  $BASE->Response()->RenderJSON([
  	'errorCode' => 1,
  	'result' => 'Error al crear movimiento, intentalo mas tarde.'
  	]);
  exit();
}

$material = FetchMaterialWithID($move->id_material);
$material->total_count += $move->pieces * ($move->type == MOVE_TYPE_ADD ? 1 : -1);

if (!$material->Update()) {
  $move->Destroy();
  $BASE->Response()->RenderJSON([
    'errorCode' => 1,
    'result' => 'Error al crear movimiento, intentalo mas tarde.'
    ]);
  exit();
}

$BASE->Response()->RenderJSON([
	'errorCode' => 0,
	'result' => 'Movimiento creado'
	]);
?>
