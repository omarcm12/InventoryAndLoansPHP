<?php

if(count(get_included_files()) == 1) exit("Direct access not permitted.");

define('USER_ADMIN', 0);
define('USER_STUDENT', 1);
define('USER_SERVICE',2);

define('STUDENT_ACTIVE',1);
define('STUDENT_LOW',0);
define('STUDENT_EVALUATION',2);

class User extends BaseModel {
  public $name;
  public $last_name;
  public $email;
  public $type;
  public $enrollment;
  public $carrer;
  public $semester;
  public $status;

  
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
      'enrollment' => PDO::PARAM_STR,
      'carrer' => PDO::PARAM_STR,
      'semester' => PDO::PARAM_STR              
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
    $full_name = $this->last_name . " " .$this->name;
    return $full_name;
  }

  public function Email() {
    return $this->email;
  }

  public function Type() {
    return $this->type;
  }

  public function Carrer() {
    return $this->carrer;
  }

  public function Semester() {
    return $this->semester;
  }

  public function Enrollment() {
    return $this->enrollment;
  }

  public function Status(){
    return $this->status;
  }

  public function IsAdmin(){
    return $this->type == USER_ADMIN;
  }

  public function IsService(){
    return $this->type == USER_SERVICE;
  }

 public function IsStudent(){
    return $this->type == USER_STUDENT;
  }

  public function StatusName(){
    $status = "Activo";
    if($this->status == STUDENT_LOW){
      $status = "Baja";
    }else if($this->status == STUDENT_EVALUATION){
      $status = "EP";
    }
    return $status;
  }

  public function StatusLabel(){
    $status = "normal";
    if($this->status == STUDENT_LOW){
      $status = "danger";
    }else if($this->status == STUDENT_EVALUATION){
      $status = "overage";
    }
    return $status;
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
