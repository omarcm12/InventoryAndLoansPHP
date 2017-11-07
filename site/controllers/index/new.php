<?php

if ($BASE->Session()->LoggedIn()) {
  $BASE->Response()->RedirectAndExit('/admin/');
}

if (AuthorsCount() == 0) {
  $BASE->Response()->RedirectAndExit('/admin/config');
}

$BASE->Response()->Render($BASE->Template());

?>
