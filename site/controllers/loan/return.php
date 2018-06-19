<?php

if ($BASE->Session()->LoggedOut()) {
  $BASE->Response()->RedirectAndExit('/', BASE_RESPONSE_REDIRECT_OTHER);
}else if(!adminCurrentUser()->IsAdmin()) {
	$BASE->Response()->ExitWithNotFound('Pagina no encontrada', '');
}

$loan = FetchLoanWithID($BASE->RouteParam(0));
if (empty($loan)) {
  $BASE->Response()->ExitWithNotFound('Prestamo no encontrado.', 'Prestamo: ' . $BASE->RouteParam(0));
}
$flag = 1;

/* BITACORA */
$move_loan = new MoveLoan();
$move_loan->id_loan = $loan->ID();
$move_loan->id_student = $loan->Student()->ID();
$move_loan->id_user = adminCurrentUser()->ID();
$move_loan->type = MOVE_TYPE_RETURN;
$move_loan->Create();
/* END BITACORA */


foreach ($loan->LoanMaterials() as $loan_material){

	/* calculate the penalty */
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
	
	$send_loan_material = $_POST["loan-material"][$loan_material->ID()];
	$returned = $send_loan_material["amount"];
	$description = $send_loan_material["description"];
	if(( $returned + $loan_material->ReturnedAmount() ) > $loan_material->Amount()){
		$returned = $loan_material->Amount();
	}else if($loan_material->Amount() < 0){
		$returned = 0;
	}
	$loan_material->returned_amount += $returned;
	//$loan_material->returned_amount = $description;
	if($loan_material->ReturnedAmount() < $loan_material->Amount()){
		$flag=0;
	}
	$material = FetchMaterialWithID($loan_material->Material()->ID());
	$material->borrowed_count -= $returned;
	$material->Update();
	$loan_material->Update();


	/*   BITACORA  */
	$move_loan_material = new MoveLoanMaterial();
	$move_loan_material->id_move_loan = $move_loan->ID();
	$move_loan_material->id_material = $loan_material->Material()->ID();
	$move_loan_material->amount = $send_loan_material["amount"];
	$move_loan_material->Create();
	/*END BITACORA  */

}
if($flag){
	$loan->status = LOAN_STATUS_ENDED;	
}


if($loan->Update()){
	$BASE->Session()->SetFlash(['success' => 'Prestamo actualizado.']);
	$BASE->Response()->RedirectAndExit('/admin/prestamos?f=3', BASE_RESPONSE_REDIRECT_OTHER);
}else{
	$BASE->Session()->SetFlash(['danger' => 'Error al finalizar prestamo.']);
	$BASE->Response()->RedirectAndExit('/admin/prestamos', BASE_RESPONSE_REDIRECT_OTHER);
}

?>