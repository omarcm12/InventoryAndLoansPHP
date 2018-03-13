<?php /* controllers/site/stock/update */

if ($BASE->Session()->LoggedOut()) {
  $BASE->Response()->RedirectAndExit('/', BASE_RESPONSE_REDIRECT_OTHER);
}else if(!adminCurrentUser()->IsAdmin()) {
	$BASE->Response()->ExitWithNotFound('Pagina no encontrada', '');
}

$configuration = FetchConfiguration();


$postParams = $BASE->PostParam('configuration');
if (empty($postParams)) { $postParams = []; }

$configuration->days_expired_loan = $postParams['days_expired'];
$configuration->days_loan = $postParams['days_loan'];
$configuration->days_price = $postParams['days_price'];

if ($configuration->Valid() && $configuration->Update()) {
  $BASE->Session()->SetFlash(['success' => 'Configuraciones actualizadas.']);
} else {
  $BASE->Session()->SetFlash(['danger' => 'Error actualizando Configuraciones.']);
}

$BASE->Response()->RedirectAndExit('/admin/configuraciones', BASE_RESPONSE_REDIRECT_OTHER);

?>
