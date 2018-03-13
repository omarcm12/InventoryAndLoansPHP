<?php
if ($BASE->Session()->LoggedOut()) {
  $BASE->Response()->RedirectAndExit('/', BASE_RESPONSE_REDIRECT_OTHER);
}else if(!adminCurrentUser()->IsStudent()) {
	$BASE->Response()->ExitWithNotFound('Pagina no encontrada', '');
}

$materials = FetchAllMaterials($BASE->GetParam('page'), 20, $BASE->GetParam('s'));
$materials->SetResultsTotal(MaterialsCount());

$loan = FetchLoanWithStudent(adminCurrentUser()->ID(), LOAN_STATUS_DRAFT);

if (empty($loan)) {
	$loan = new Loan();
	$loan->id_student = adminCurrentUser()->ID();
	$loan->status = LOAN_STATUS_DRAFT; 		
	if (!($loan->Valid() && $loan->Create())) {			
		$BASE->Session()->SetFlash(['danger' => 'Error creando prestamo. Inténtalo más tarde']);
		$BASE->Response()->RedirectAndExit('/alumnos', BASE_RESPONSE_REDIRECT_OTHER);
	}
}


$vars = [
	'materials' => $materials,
	'search_default_value' => $BASE->GetParam('s'),
	'loan' => $loan
];
$BASE->Response()->Render($BASE->Template(), $vars);

?>