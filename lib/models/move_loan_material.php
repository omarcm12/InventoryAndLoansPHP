<?php

if(count(get_included_files()) == 1) exit("Direct access not permitted.");

class MoveLoanMaterial extends BaseModel {
  public $id_move_loan;
  public $id_material;
  public $amount;

  private $move_loan;
  private $material;
  
  public function AttributesForCreate() {
    return [
      'id_move_loan' => PDO::PARAM_INT,      
      'id_material' => PDO::PARAM_INT,       
      'amount' => PDO::PARAM_INT 
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


  public function MoveLoan(){
    if(empty($this->move_loan)){
      return FetchMoveLoanWithID($this->id_move_loan);
    }else{
      return $this->move_loan;
    }
  }

  public function Amount() {
    return $this->amount;
  }


  public function Valid() {
    if (is_null($this->id_material)) { return false; } 
    if (is_null($this->id_move_loan)) { return false; }
    if (empty($this->amount)) { return false; }       
    return true;
  }
}

require_once(BASE_LIB_FOLDER . 'helpers/move_loan_material.php');
?>