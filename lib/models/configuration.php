<?php

if(count(get_included_files()) == 1) exit("Direct access not permitted.");


class Configuration extends BaseModel {
  public $days_expired_loan;
  public $days_price;
  
  public function AttributesForCreate() {
    return [   
      'days_expired_loan' => PDO::PARAM_INT,
      'days_price' => PDO::PARAM_INT
               
    ];
  }

  public function AttributesForUpdate() {
    return [
      'days_expired_loan' => PDO::PARAM_INT,
      'days_price' => PDO::PARAM_INT
               
    ];
  }

  public function AttributesWithTimestamps() {
    return true;
  }

  public function DaysExpiredLoan() {
    return $this->days_expired_loan;
  }  


  public function DaysPrice() {
    return $this->days_price;
  }


  public function Valid() {     
    if (empty($this->days_expired_loan)) { return false; }           
    if (empty($this->days_price)) { return false; }
    return true;
  }
}

require_once(BASE_LIB_FOLDER . 'helpers/configuration.php');
?>
