<?php

if ($BASE->Session()->LoggedIn()) {
  $BASE->Response()->RedirectAndExit('/admin/', BASE_RESPONSE_REDIRECT_OTHER);
}

$vars = [];

$BASE->Response()->Render($BASE->Template(), $vars);

?>