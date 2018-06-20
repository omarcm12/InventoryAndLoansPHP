<?php
/* User tipe Service change to student */

	$user = FetchUserWithID(adminCurrentUser()->ID());
	if($user->Type() == USER_SERVICE ){
		updateTypeStudentWithID($user->ID(),USER_STUDENT);
	}

/* end verification */
$BASE->Session()->Reset();
$BASE->Response()->RedirectAndExit('https://accounts.google.com/logout');

?>
