<?php

if ($BASE->Session()->LoggedOut()) {
  $BASE->Response()->RedirectAndExit('/', BASE_RESPONSE_REDIRECT_OTHER);
}

$vars = [
	'material' => new Material()
];

$BASE->Response()->Render($BASE->Template(), $vars);

?>