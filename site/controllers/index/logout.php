<?php
/* User tipe Service change to student */

	$user = FetchUserWithID(adminCurrentUser()->ID());
	if($user->Type() == USER_SERVICE ){
		updateTypeStudentWithID($user->ID(),USER_STUDENT);
		$BASE->Session()->SetFlash(['success' => 'Usuario actualizado']);
	}else{
		$BASE->Session()->SetFlash(['success' => 'Usuario no actualizado']);
	}

/* end verification */
$BASE->Session()->Reset();
$BASE->Response()->RedirectAndExit('/');

?>
