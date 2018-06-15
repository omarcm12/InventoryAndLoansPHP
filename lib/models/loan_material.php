<?php

if(count(get_included_files()) == 1) exit("Direct access not permitted.");


class LoanMaterial extends BaseModel {
  public $id_loan;
  public $id_material;
  public $amount;
  public $description;
  public $returned_amount;
  public $deliver_at;
  public $return_at;
  public $return_unix;

  private $loan;
  private $material;
  
  public function AttributesForCreate() {
    return [
      'id_loan' => PDO::PARAM_INT,      
      'id_material' => PDO::PARAM_INT, 
      'description' => PDO::PARAM_STR,      
      'amount' => PDO::PARAM_INT,
      'returned_amount' => PDO::PARAM_INT,
      'return_unix' => PDO::PARAM_INT,
      'deliver_at' => MYSQLI_TYPE_TIMESTAMP,
      'return_at' => MYSQLI_TYPE_TIMESTAMP,                   
    ];
  }

  public function AttributesForUpdate() {
    return $this->AttributesForCreate();
  }

  public function DeliverAt(){
    /*return $this->deliver_at;*/
    //return empty($this->deliver_at) ? null : strtotime($this->deliver_at);
    return strftime('%d-%m-%Y',strtotime($this->deliver_at));
  }

  public function ReturnAt(){
    /*return empty($this->return_at) ? null : strtotime($this->return_at);*/
    return date('%d-%m-%Y',strtotime($this->return_at));
  }

  public function AgeReturnAt(){
    //return strftime('%d-%m-%Y',strtotime($this->return_at)-100); 
    $format = BASE_SIMPLE_DATE_FORMAT;
   // return /*strftime($format, */$this->return_at;
    return date("d-m-Y",$this->return_unix); // php 5.6.x
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

  public function Loan(){
    if(empty($this->loan)){
      return FetchLoanWithID($this->id_loan);
    }else{
      return $this->loan;
    }
  }

  public function Amount() {
    return $this->amount;
  }

  public function ReturnedAmount() {
    return $this->returned_amount;
  }

  public function ReturnUnix() {
    return $this->return_unix;
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