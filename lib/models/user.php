<?php

if(count(get_included_files()) == 1) exit("Direct access not permitted.");

define('USER_ADMIN', 0);
define('USER_STUDENT', 1);

class User extends BaseModel {
  public $name;
  public $last_name;
  public $email;
  public $type;

  
  public function AttributesForCreate() {
    return [
      'name' => PDO::PARAM_STR,      
      'last_name' => PDO::PARAM_STR,
      'email' => PDO::PARAM_STR,
      'type' => PDO::PARAM_INT                  
    ];
  }

  public function AttributesForUpdate() {
    return [
      'name' => PDO::PARAM_STR,      
      'last_name' => PDO::PARAM_STR,
      'email' => PDO::PARAM_STR,
      'type' => PDO::PARAM_INT                  
    ];
  }

  public function AttributesWithTimestamps() {
    return true;
  }

  public function LastName() {
    return $this->last_name;
  }


  public function Name() {
    return $this->name;
  }  

  public function FullName() {
    $full_name = $this->name . " " .$this->last_name;
    return $full_name;
  }

  public function Email() {
    return $this->email;
  }

  public function Type() {
    return $this->type;
  }

  public function IsAdmin(){
    return $this->type == USER_ADMIN;
  }

 public function IsStudent(){
    return $this->type == USER_STUDENT;
  }

  public function Valid() {
    if (empty($this->name)) { return false; }       
    if (empty($this->last_name)) { return false; }    
    if (empty($this->email)) { return false; }       

    return true;
  }
}

require_once(BASE_LIB_FOLDER . 'helpers/user.php');
?>
