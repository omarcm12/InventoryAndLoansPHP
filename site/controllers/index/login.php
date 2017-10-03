<?php


$postParams = $BASE->PostParam('login');
if (empty($postParams)) { 
	$postParams = []; 
}

if (empty($postParams['email']) || empty($postParams['pass'])) {			  	
 	$BASE->Session()->SetFlash(['danger' => 'Favor de ingresar datos']);
	$BASE->Response()->RedirectAndExit('/', BASE_RESPONSE_REDIRECT_OTHER); 	
}

if ($postParams['email'] != "test@mail.com" || $postParams['pass'] != "test123") {			  	
 	$BASE->Session()->SetFlash(['danger' => 'Usuario o contraseña incorrecto']);
	$BASE->Response()->RedirectAndExit('/', BASE_RESPONSE_REDIRECT_OTHER); 	
}

$BASE->Response()->RedirectAndExit('/inventario/', BASE_RESPONSE_REDIRECT_OTHER);
?>