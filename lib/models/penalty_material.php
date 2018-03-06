<?php

if(count(get_included_files()) == 1) exit("Direct access not permitted.");


class Penalty_material extends BaseModel {

  public $id_material;
  public $id_loan_material;
  public $id_student;
  public $amount;
  public $pieces;
  public $status;
  public $days;

  private $material;
  private $loan_material;
  private $student;
  
  public function AttributesForCreate() {
    return [
      'id_student' => PDO::PARAM_INT,      
      'id_material' => PDO::PARAM_INT,
      'id_loan_material' => PDO::PARAM_INT,
      'pieces' => PDO::PARAM_INT,      
      'amount' => PDO::PARAM_INT,
      'status' => PDO::PARAM_INT,
      'days' => PDO::PARAM_INT      
    ];
  }

  public function AttributesForUpdate() {
    return $this->AttributesForCreate();
  }

  public function Status(){
    return $this->status;
  }

  public function Amount(){
    return $this->amount;
  }

  public function Days(){
    return $this->days;
  }

  public function Pieces(){
    return $this->pieces;
  }

  public function AttributesWithTimestamps() {
    return true;
  }

  public function Student() {
    if(is_null($this->student))
      $this->student = FetchUserWithID($this->id_student);
    return $this->student;
  }

   public function Material() {
    if(is_null($this->material))
      $this->material = FetchMaterialWithID($this->id_material);    
    return $this->material;
  }

  public function LoanMaterial() {
    if(is_null($this->loan_material))
      $this->loan_material = FetchLoanMaterialWithID($this->id_loan_material);    
    return $this->loan_material;
  }


  public function Valid() {
    if (empty($this->id_student)) { return false; }               

    return true;
  }
}

require_once(BASE_LIB_FOLDER . 'helpers/loan.php');
require_once(BASE_LIB_FOLDER . 'helpers/material.php');
require_once(BASE_LIB_FOLDER . 'helpers/loan_material.php');
require_once(BASE_LIB_FOLDER . 'helpers/penalty_material.php');
?>
