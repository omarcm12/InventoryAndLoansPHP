<?php

if ($BASE->Session()->LoggedOut()) {
  $BASE->Response()->RedirectAndExit('/', BASE_RESPONSE_REDIRECT_OTHER);
}else if(!adminCurrentUser()->IsAdmin()) {
	$BASE->Response()->ExitWithNotFound('Pagina no encontrada', '');
}

$students = FetchUsers($BASE->GetParam('page'), 20, $BASE->GetParam('s'), $BASE->GetParam('o'));
$students->SetResultsTotal(UsersCount());



$BASE->Response()->Render($BASE->Template(), $vars);

?>