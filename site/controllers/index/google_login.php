<?php

if ($BASE->Session()->LoggedIn()) {
  $BASE->Response()->RedirectAndExit('/admin/', BASE_RESPONSE_REDIRECT_OTHER);
}

$googleClient = new Google_Client();
$guzzleClient = new \GuzzleHttp\Client(array( 'curl' => array( CURLOPT_SSL_VERIFYPEER => false, ), ));
$googleClient->setHttpClient($guzzleClient);
$googleClient->setClientId('994740818446-91af3kmlviemld7e58ut1q682h27vf1t.apps.googleusercontent.com');
$googleClient->setClientSecret('R-3ZrUrHFYbfGTNGutsme9l6');
$googleClient->setRedirectUri('index/login');
$googleClient->setScopes('name');
$googleClient->setScopes('email');



?>
