<?php

if ($BASE->Session()->LoggedOut()) {
  $BASE->Response()->RedirectAndExit('/', BASE_RESPONSE_REDIRECT_OTHER);
}else if(!adminCurrentUser()->IsAdmin()) {
	$BASE->Response()->ExitWithNotFound('Pagina no encontrada', '');
}

$configuration = FetchConfiguration();

$vars = [
	'configuration' => $configuration
];
$BASE->Response()->Render($BASE->Template(), $vars);

?>