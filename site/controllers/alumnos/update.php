<?php
if ($BASE->Session()->LoggedOut()) {
  $BASE->Response()->RedirectAndExit('/', BASE_RESPONSE_REDIRECT_OTHER);
}else if(!adminCurrentUser()->IsStudent()) {
	$BASE->Response()->ExitWithNotFound('Pagina no encontrada', '');
}else if (adminCurrentUser()->Status() == STUDENT_PENDING){
	$BASE->Response()->RedirectAndExit('/post-registro/', BASE_RESPONSE_REDIRECT_OTHER);
}

$student = FetchStudentWithID($BASE->RouteParam(0));

if(empty($student)){
	$BASE->Response()->ExitWithNotFound('Alumno no encontrado.', 'Alumno: ' . $BASE->RouteParam(0));
}
$postParams = $BASE->postParam('student');
if(empty($postParams)){ $postParams = []; }


$BASE->SetSessionParam('student', $postParams);

$student->name = $postParams['name'];
if(strlen($student->name) < 2){
	$BASE->Session()->SetFlash(['danger' => 'Nombre demaciado corto.']);
  	$BASE->Response()->RedirectAndExit('/alumnos/infopersonal/', BASE_RESPONSE_REDIRECT_OTHER);	
}

$student->last_name = $postParams['last_name'];
if(strlen($student->last_name) < 2){
	$BASE->Session()->SetFlash(['danger' => 'Apellido demaciado corto.']);
  	$BASE->Response()->RedirectAndExit('/alumnos/infopersonal/', BASE_RESPONSE_REDIRECT_OTHER);	
}


$student->enrollment = $postParams['enrollment'];

if(strlen($student->enrollment) < 4){
	$BASE->Session()->SetFlash(['danger' => 'Matricula demaciado corta.']);
  	$BASE->Response()->RedirectAndExit('/alumnos/infopersonal/', BASE_RESPONSE_REDIRECT_OTHER);	
}

if(!is_numeric($student->enrollment)){
	$BASE->Session()->SetFlash(['danger' => 'Matricula incorrecta.']);
  	$BASE->Response()->RedirectAndExit('/alumnos/infopersonal/', BASE_RESPONSE_REDIRECT_OTHER);	
}

$oldStudent = FetchUserWithEnrollment($student->enrollment);
if($oldStudent && $oldStudent->ID() != $student->ID()){
	$BASE->Session()->SetFlash(['danger' => 'Matricula ya se encuentra registrada: ' . $student->enrollment]);
  	$BASE->Response()->RedirectAndExit('/alumnos/infopersonal/', BASE_RESPONSE_REDIRECT_OTHER);	
}

$student->carrer = $postParams['carrer'];
if(strlen($student->carrer) < 4){
	$BASE->Session()->SetFlash(['danger' => 'Carrera incorrecta.']);
  	$BASE->Response()->RedirectAndExit('/alumnos/infopersonal/', BASE_RESPONSE_REDIRECT_OTHER);	
}


$student->semester = $postParams['semester'];

if(!is_numeric($student->enrollment) || ((int) $student->semester) < 1 || ((int) $student->semester) > 12 ){
	$BASE->Session()->SetFlash(['danger' => 'Semestre incorrecto.']);
  	$BASE->Response()->RedirectAndExit('/alumnos/infopersonal/', BASE_RESPONSE_REDIRECT_OTHER);	
}

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