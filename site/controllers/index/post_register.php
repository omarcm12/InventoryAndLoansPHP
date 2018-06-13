<?php 

$student = FetchStudentWithID(adminCurrentUser()->ID());

if(!$student->IsStudent()){
	$BASE->Response()->ExitWithNotFound('Pagina no encontrada', '');
}else if ($student->Status() != STUDENT_PENDING){
	$BASE->Response()->RedirectAndExit('/alumnos', BASE_RESPONSE_REDIRECT_OTHER);
}

if(is_null($student))
	$BASE->Response()->RedirectAndExit('/', BASE_RESPONSE_REDIRECT_OTHER);

if ($BASE->SessionParam('student')) {
	$postParams = $BASE->SessionParam('student');
	$student->name = $postParams['name'];
	$student->last_name = $postParams['last_name'];
	$student->enrollment = $postParams['enrollment'];	
	$student->carrer = $postParams['carrer'];
	$student->semester = $postParams['semester'];
}
$BASE->SetSessionParam('student', null);

$vars = [
	'student' => $student
];


$BASE->Response()->Render($BASE->Template(), $vars);

 ?>