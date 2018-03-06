<?php /* controllers/admin/payment/new */

if ($BASE->Session()->LoggedOut()) {
  $BASE->Response()->RedirectAndExit('/', BASE_RESPONSE_REDIRECT_OTHER);
}else if(!adminCurrentUser()->IsAdmin()) {
	$BASE->Response()->ExitWithNotFound('Pagina no encontrada', '');
}

$payment = new Payment();
$id = $BASE->RouteParam(0);
$postParams = $BASE->PostParam('payment');
if (empty($postParams)) { $postParams = []; }

$payment->id_penalty = $id;
$payment->id_student = $postParams['id_student'];
$payment->id_employee = adminCurrentUser()->ID();
$payment->description = $postParams['description'];
$payment->amount = $postParams['amount'];
$payment->amount_payd=$postParams['amount_payd'];

$penalty = FetchPenaltyWithID($id);

if ($payment->Valid() && $payment->Create()) {
	$penalty->status = 2;
	$penalty->Update();			
	$BASE->Session()->SetFlash(['success' => 'Pago Registrado.']);
	$BASE->Response()->RedirectAndExit('/admin/adeudos', BASE_RESPONSE_REDIRECT_OTHER);
}

$BASE->Session()->SetFlash(['danger' => 'Error guardando el movimiento.']);
$BASE->Response()->RedirectAndExit('/admin/adeudos', BASE_RESPONSE_REDIRECT_OTHER);

?>
