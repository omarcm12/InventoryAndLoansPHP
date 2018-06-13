<?php
if ($BASE->Session()->LoggedOut()) {
  $BASE->Response()->RedirectAndExit('/', BASE_RESPONSE_REDIRECT_OTHER);
}else if(!adminCurrentUser()->IsStudent()) {
	$BASE->Response()->ExitWithNotFound('Pagina no encontrada', '');
}else if (adminCurrentUser()->Status() == STUDENT_PENDING){
	$BASE->Response()->RedirectAndExit('/post-registro/', BASE_RESPONSE_REDIRECT_OTHER);
}

$item_per_page = 50;
$complete_list = FetchAllMaterials(1, 10000, $BASE->GetParam('s'));
$total_items = count($complete_list);
$materials = FetchAllMaterials($BASE->GetParam('page'), $item_per_page, $BASE->GetParam('s'));
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
	'total_items' => $total_items,
	'item_per_page' => $item_per_page,
	'search_default_value' => $BASE->GetParam('s'),
	'loan' => $loan
];
$BASE->Response()->Render($BASE->Template(), $vars);

?>