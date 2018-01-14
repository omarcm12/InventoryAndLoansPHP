<?php
if ($BASE->Session()->LoggedOut()) {
  $BASE->Response()->RedirectAndExit('/', BASE_RESPONSE_REDIRECT_OTHER);
}else if(!adminCurrentUser()->IsStudent()) {
	$BASE->Response()->ExitWithNotFound('Pagina no encontrada', '');
}

$student = FetchStudentWithID($BASE->RouteParam(0));

if(empty($student)){
	$BASE->Response()->ExitWithNotFound('Alumno no encontrado.', 'Alumno: ' . $BASE->RouteParam(0));
}
$postParams = $BASE->postParam('student');
if(empty($postParams)){ $postParams = []; }

/*UpdateInfoStudent($postParams['name'], $postParams['last_name'],$postParams['enrollment'], $postParams['carrer'], $postParams['semester']);*/
$student->name = $postParams['name'];
$student->last_name = $postParams['last_name'];
$student->enrollment = $postParams['enrollment'];
$student->carrer = $postParams['carrer'];
$student->semester = $postParams['semester'];

if ($student->Valid() && $student->Update()) {
  $BASE->Session()->SetFlash(['success' => 'Informacion actualizada.']);
} else {
  $BASE->Session()->SetFlash(['danger' => 'Error al actualizar informacion.']);
}


/*$vars = [
	'student' => new User()
];*/

$BASE->Response()->RedirectAndExit('/alumnos/infopersonal/', BASE_RESPONSE_REDIRECT_OTHER);
//$BASE->Response()->Render($BASE->Template(), $vars);
?>