<?php

if(count(get_included_files()) == 1) exit("Direct access not permitted.");

class LoanMaterial extends BaseModel {
  public $id_loan;
  public $id_material;
  public $amount;
  public $description;
  public $returned_amount;

  private $loan;
  private $material;
  
  public function AttributesForCreate() {
    return [
      'id_loan' => PDO::PARAM_INT,      
      'id_material' => PDO::PARAM_INT, 
      'description' => PDO::PARAM_INT,      
      'amount' => PDO::PARAM_INT,
      'returned_amount' => PDO::PARAM_INT                  
    ];
  }

  public function AttributesForUpdate() {
    return $this->AttributesForCreate();
  }

  public function Material() {
    if(is_null($this->material))
      $this->material = FetchMaterialWithID($this->id_material);    
    return $this->material;
  }

  public function FetchLoanWithID() {
    if(is_null($this->loan))
      $this->loan = FetchUserWithID($this->id_loan);
    return $this->loan;
  }

  public function Amount() {
    return $this->amount;
  }

  public function ReturnedAmount() {
    return $this->returned_amount;
  }

  public function Description() {
    return $this->description;
  }

  public function ShortDescription($length = 400) {
    $blurb = $this->blurb;
    if (empty($blurb)) {
      $blurb = textTrim($this->body, $length, true, true);      
    }
    return $blurb;
  }

  public function Valid() {
    if (is_null($this->id_material)) { return false; } 
    if (is_null($this->id_loan)) { return false; }
    if (empty($this->amount)) { return false; }       
    return true;
  }
}

require_once(BASE_LIB_FOLDER . 'helpers/loan_material.php');
?>