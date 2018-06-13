<?php

if ($BASE->Session()->LoggedIn()) {
  $BASE->Response()->RedirectAndExit('/admin/', BASE_RESPONSE_REDIRECT_OTHER);
}

$googleClient = new Google_Client();
$guzzleClient = new \GuzzleHttp\Client(array( 'curl' => array( CURLOPT_SSL_VERIFYPEER => false, ), ));
$googleClient->setHttpClient($guzzleClient);
$googleClient->setClientId('994740818446-91af3kmlviemld7e58ut1q682h27vf1t.apps.googleusercontent.com');
$googleClient->setClientSecret('R-3ZrUrHFYbfGTNGutsme9l6');
$googleClient->setRedirectUri('http://localhost:8888/login');
$googleClient->setScopes(['profile']);

if(isset($_GET["code"])){
	try {
	    $googleClient->authenticate($_GET["code"]);	    
	} catch (Exception $e) {
	    $BASE->Response()->RedirectAndExit('/', BASE_RESPONSE_REDIRECT_OTHER);
	}		
	$payload = $googleClient->verifyIdToken();
	
	$oauth2 = new Google_Service_Oauth2($googleClient);
	$userinfo = $oauth2->userinfo_v2_me->get();

	$user = FetchUserWithEmail($payload['email']);
	if ($user) {
	  	$BASE->Session()->Login($user);
	}else{
		$user = new User();
		$user->email = $payload['email'];
		$user->name = '';
		$user->last_name = '';
		try {
	    	$user->name = $userinfo["givenName"];	    	
			$user->last_name = $userinfo["familyName"];
		} catch (Exception $e) {
		    $BASE->Response()->RedirectAndExit('/', BASE_RESPONSE_REDIRECT_OTHER);
		}		
		$user->type = USER_STUDENT;
		$user->status = STUDENT_PENDING;
		$user->google_id = $payload["sub"];
		$user->Create();

		$user = FetchUserWithEmail($payload['email']);
		if($user){
			$BASE->Session()->Login($user);
		}else{
			$BASE->Response()->RedirectAndExit('/', BASE_RESPONSE_REDIRECT_OTHER);		
		}
	}
}else{
	$BASE->Response()->RedirectAndExit('/', BASE_RESPONSE_REDIRECT_OTHER);
}

if($user->Type() == USER_ADMIN){
	$BASE->Response()->RedirectAndExit('/admin/', BASE_RESPONSE_REDIRECT_OTHER);
}else if($user->Type() == USER_STUDENT){
	if($user->Status() == STUDENT_PENDING){
		$BASE->Response()->RedirectAndExit('/post-registro/', BASE_RESPONSE_REDIRECT_OTHER);
	}else{
		$BASE->Response()->RedirectAndExit('/alumnos/', BASE_RESPONSE_REDIRECT_OTHER);
	}	
}else if($user->Type() == USER_SERVICE){
	$BASE->Response()->RedirectAndExit('/servicio/', BASE_RESPONSE_REDIRECT_OTHER);
}

?>
