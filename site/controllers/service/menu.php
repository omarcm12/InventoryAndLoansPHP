<?php
if ($BASE->Session()->LoggedOut()) {
  $BASE->Response()->RedirectAndExit('/', BASE_RESPONSE_REDIRECT_OTHER);
}else if(!adminCurrentUser()->IsService()) {
	$BASE->Response()->ExitWithNotFound('Pagina no encontrada', '');
}

$vars = [
	
];

$BASE->Response()->Render($BASE->Template(), $vars);

?>