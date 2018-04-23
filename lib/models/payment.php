<?php

if(count(get_included_files()) == 1) exit("Direct access not permitted.");

class Payment extends BaseModel {

  public $id_penalty;
  public $id_student;
  public $id_employee;
  public $description;
  public $amount;
  public $amount_payd;

  private $student;
  private $employee;
  private $penalty;
  
  public function AttributesForCreate() {
    return [
      'id_penalty' => PDO::PARAM_INT,      
      'id_student' => PDO::PARAM_INT,
      'id_employee' => PDO::PARAM_INT,
      'description' => PDO::PARAM_INT,
      'amount_payd' => PDO::PARAM_INT,      
      'amount' => PDO::PARAM_INT      
    ];
  }

  public function AttributesForUpdate() {
    return $this->AttributesForCreate();
  }

  public function Description(){
    return $this->description;
  }

  public function Amount(){
    return $this->amount;
  }

  public function AmountPayd(){
    return $this->amount_payd;
  }

  public function AttributesWithTimestamps() {
    return true;
  }

  public function Student() {
    if(is_null($this->student))
      $this->student = FetchUserWithID($this->id_student);
    return $this->student;
  }

  public function Penalty() {
    if(is_null($this->penalty))
      $this->penalty = FetchPenaltyWithID($this->id_penalty);    
    return $this->penalty;
  }

   public function Employee() {
    if(is_null($this->employee))
      $this->employee = FetchUserWithID($this->id_employee);    
    return $this->employee;
  }

  /*public function LoanMaterial() {
    if(is_null($this->loan_material))
      $this->loan_material = FetchLoanMaterialWithID($this->id_loan_material);    
    return $this->loan_material;
  }*/


  public function Valid() {
    if (empty($this->id_student)) { return false; }               

    return true;
  }
}

require_once(BASE_LIB_FOLDER . 'helpers/user.php');
require_once(BASE_LIB_FOLDER . 'helpers/material.php');
require_once(BASE_LIB_FOLDER . 'helpers/loan_material.php');
require_once(BASE_LIB_FOLDER . 'helpers/payment.php');

?>
