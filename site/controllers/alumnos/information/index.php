<?php
if ($BASE->Session()->LoggedOut()) {
  $BASE->Response()->RedirectAndExit('/', BASE_RESPONSE_REDIRECT_OTHER);
}else if(!adminCurrentUser()->IsStudent()) {
	$BASE->Response()->ExitWithNotFound('Pagina no encontrada', '');
}else if (adminCurrentUser()->Status() == STUDENT_PENDING){
	$BASE->Response()->RedirectAndExit('/post-registro/', BASE_RESPONSE_REDIRECT_OTHER);
}

$student = FetchStudentWithID(adminCurrentUser()->ID());

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