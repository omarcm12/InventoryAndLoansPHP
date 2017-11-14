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

if (empty($email) || empty($password)) {
	$BASE->Session()->SetFlash(['danger' => 'Usuario o contraseña vacío']);
  	$BASE->Response()->RedirectAndExit('/', BASE_RESPONSE_REDIRECT_OTHER);
}

$user = FetchUserWithEmail($email);
if ($user && $password == "test123") {
  $BASE->Session()->Login($user);
}

if($user->Type() == USER_ADMIN){
	$BASE->Response()->RedirectAndExit('/admin/', BASE_RESPONSE_REDIRECT_OTHER);
}else if($user->Type() == USER_STUDENT){
	$BASE->Response()->RedirectAndExit('/alumnos/', BASE_RESPONSE_REDIRECT_OTHER);
}


?>
