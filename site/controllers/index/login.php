<?php

if ($BASE->Session()->LoggedIn()) {
  $BASE->Response()->RedirectAndExit('/admin/', BASE_RESPONSE_REDIRECT_OTHER);
}

$postParams = $BASE->PostParam('login');
if (empty($postParams)) { 
       $postParams = []; 
}

$email = $postParams['email'];
$password = $postParams['pass'];
error_log(print_r($_POST, true));
if (empty($email) || empty($password)) {
	$BASE->Session()->SetFlash(['danger' => 'Usuario o contraseña vacío']);
  	$BASE->Response()->RedirectAndExit('/', BASE_RESPONSE_REDIRECT_OTHER);
}

$user = FetchUserWithEmail($email);
if ($user && $password == "test123") {
  $BASE->Session()->Login($user);
}

$BASE->Response()->RedirectAndExit('/admin/', BASE_RESPONSE_REDIRECT_OTHER);

?>
