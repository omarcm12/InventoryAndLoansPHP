<?php

if ($BASE->Session()->LoggedOut()) {
  $BASE->Response()->RedirectAndExit('/', BASE_RESPONSE_REDIRECT_OTHER);
}else if(!adminCurrentUser()->IsAdmin()) {
	$BASE->Response()->ExitWithNotFound('Pagina no encontrada', '');
}

$loans_materials = FetchPossiblePenaltys();
//if(!empty($loans_materials)){
	foreach ($loans_materials as $loan_material) {
		//$BASE->Session()->SetFlash(['danger' => 'Error al actualizar multas.'+ strtotime($loan_material->ReturnAt()) ]);
		if(strtotime($loan_material->ReturnAt())<time()){
			$penalty = FetchPenaltyWithIDLoanMaterial($loan_material->ID());
		if(empty($penalty)){
			$penalty = new Penalty_material();
			$penalty->id_student = $loan_material->Loan()->IdStudent();
			$penalty->id_material = $loan_material->Material()->ID();
			$penalty->id_loan_material = $loan_material->ID();
			$penalty->pieces = $loan_material->Amount();
			$penalty->status = 1;
			$penalty->days = 0;
			$penalty->amount = 0;
			if(!($penalty->Valid() && $penalty->Create())){
				$BASE->Session()->SetFlash(['danger' => 'Error creando multa. Inténtalo más tarde']);
			$BASE->Response()->RedirectAndExit('/admin', BASE_RESPONSE_REDIRECT_OTHER);
			}
		}
		$configuration = FetchConfiguration();
		$student = $loan_material->Loan()->Student();
		if($student->Status() == 1 || $student->Status() == 2 ){  /* STATUS 1 = ACTIVE, STATUS 2 = EVALUATION*/
			$penalty->days = FetchDaysPenalty(strtotime($loan_material->ReturnAt()));
			$penalty->amount = $penalty->Days()*$penalty->Pieces() * $configuration->DaysPrice();
			if(!$penalty->Update()){
				$BASE->Session()->SetFlash(['danger' => 'Error al actualizar multas.']);
			}
		}
		
		
		}
		
	}

//}

$penaltys = FetchAllPenaltys($BASE->GetParam('page'), 20, $BASE->GetParam('s'), $BASE->GetParam('o'));
$penaltys->SetResultsTotal(PenaltysCount());
$loans_materials = FetchPossiblePenaltys();
//ReportAllMaterials();
$sort_code = $BASE->GetParam('o');
$vars = [
	'loans_materials' => $loans_materials,
	'penaltys' => $penaltys,
	'search_default_value' => $BASE->GetParam('s')
];

$BASE->Response()->Render($BASE->Template(), $vars);

?>