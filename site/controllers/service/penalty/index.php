<?php

if ($BASE->Session()->LoggedOut()) {
  $BASE->Response()->RedirectAndExit('/', BASE_RESPONSE_REDIRECT_OTHER);
}else if(!adminCurrentUser()->IsService()) {
	$BASE->Response()->ExitWithNotFound('Pagina no encontrada', '');
}

$loans_materials = FetchPossiblePenaltys();

	foreach ($loans_materials as $loan_material) {
		$student = $loan_material->Loan()->Student();
		if($student->Status() != 0){   //status 0 = baja
			if($loan_material->ReturnUnix()<time()){
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
				$penalty->days = FetchDaysPenalty($loan_material->ReturnUnix());
				$penalty->amount = $penalty->Days()*$penalty->Pieces() * $configuration->DaysPrice();
					
				if(!$penalty->Update()){
					$BASE->Session()->SetFlash(['danger' => 'Error al actualizar multas.']);
				}
				
			
			
			}
		
		}	
	}


$item_per_page = 50;
$complete_list = FetchAllPenaltys(1, 10000, $BASE->GetParam('s'), $BASE->GetParam('o'));
$total_items = count($complete_list);
$penaltys = FetchAllPenaltys($BASE->GetParam('page'), $item_per_page, $BASE->GetParam('s'), $BASE->GetParam('o'));
$penaltys->SetResultsTotal(PenaltysCount());
$loans_materials = FetchPossiblePenaltys();
//ReportAllMaterials();
$sort_code = $BASE->GetParam('o');
$vars = [
	'loans_materials' => $loans_materials,
	'total_items' => $total_items,
	'item_per_page' => $item_per_page,
	'penaltys' => $penaltys,
	'search_default_value' => $BASE->GetParam('s')
];

$BASE->Response()->Render($BASE->Template(), $vars);

?>