<?php

if ($BASE->Session()->LoggedOut()) {
  $BASE->Response()->RedirectAndExit('/', BASE_RESPONSE_REDIRECT_OTHER);
}else if(!adminCurrentUser()->IsAdmin()) {
	$BASE->Response()->ExitWithNotFound('Pagina no encontrada', '');
}

	$postParams = $BASE->PostParam('student');
	$id = $BASE->RouteParam(0);

	if($postParams['active'] == 1 && $postParams['ep'] == 0 && $postParams['baja'] == 0){
		$status=1;   /* ACTIVE */
	}elseif ($postParams['active'] == 0 && $postParams['ep'] == 1 && $postParams['baja'] == 0) {
		$status=2;	/* EP */
	}elseif ($postParams['active'] == 0 && $postParams['ep'] == 0 && $postParams['baja'] == 1) {
		 $status=0;	/* BAJA */
	}else{
		$BASE->Session()->SetFlash(['danger' => 'Error no es posible estado indicado.']);
		$BASE->Response()->RedirectAndExit('/admin/alumnos', BASE_RESPONSE_REDIRECT_OTHER);
	}
	if($postParams['service'] == 1 && $postParams['notService'] == 0){
		updateTypeStudentWithID($id,2);
		updateStatusStudentWithID($id, $status);
	}elseif($postParams['service'] == 0 && $postParams['notService'] == 1){
		updateTypeStudentWithID($id,1);
		updateStatusStudentWithID($id, $status);
	}else{
		$BASE->Session()->SetFlash(['danger' => 'Error no es posible estado indicado.']);
		$BASE->Response()->RedirectAndExit('/admin/alumnos', BASE_RESPONSE_REDIRECT_OTHER);	
	}

	$BASE->Session()->SetFlash(['success' => 'Cambios guardados.']);
		$BASE->Response()->RedirectAndExit('/admin/alumnos', BASE_RESPONSE_REDIRECT_OTHER);
?>