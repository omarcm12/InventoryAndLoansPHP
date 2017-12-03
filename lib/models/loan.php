<?php

if(count(get_included_files()) == 1) exit("Direct access not permitted.");

define('LOAN_STATUS_DRAFT', 0);
define('LOAN_STATUS_WAITING', 1);
define('LOAN_STATUS_IN_PROGRESS', 2);
define('LOAN_STATUS_ENDED', 3);

class Loan extends BaseModel {
  public $id_student;
  public $id_employee;
  public $status;

  private $student;
  private $employee;
  private $materials;
  
  public function AttributesForCreate() {
    return [
      'id_student' => PDO::PARAM_INT,      
      'id_employee' => PDO::PARAM_INT,      
      'status' => PDO::PARAM_INT      
    ];
  }

  public function AttributesForUpdate() {
    return $this->AttributesForCreate();
  }

  public function AttributesWithTimestamps() {
    return true;
  }

  public function Student() {
    if(is_null($this->student))
      $this->student = FetchUserWithID($this->id_student);
    return $this->student;
  }

  public function Employee() {
    if(is_null($this->employee))
      $this->employee = FetchUserWithID($this->id_employee);
    return $this->employee;
  }

  public function Status() {
    return $this->status;
  }  

  public function LoanMaterials(){
    if(is_null($this->materials))
      $this->materials = FetchLoanMaterialWithLoanID($this->ID());
    return $this->materials;
  }

  public function isInMaterials($material){
    $is_in = false;
    foreach ($this->LoanMaterials() as $_material) {      
      if($material->ID() == $_material->Material()->ID()) {
        $is_in = true;
        break;
      }
    }
    return $is_in;
  }

  public function Valid() {
    if (empty($this->id_student)) { return false; }               

    return true;
  }
}

require_once(BASE_LIB_FOLDER . 'helpers/loan.php');
?>
