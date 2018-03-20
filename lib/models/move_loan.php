<?php

if(count(get_included_files()) == 1) exit("Direct access not permitted.");

define('MOVE_TYPE_DELIVER', 0);
define('MOVE_TYPE_RETURN', 1);

class MoveLoan extends BaseModel {
  public $id_loan;
  public $id_student;
  public $id_user;
  public $type;
  public $pieces;  

  private $student;
  private $loan;
  private $user;

  public function AttributesForCreate() {
    return [   
      'id_loan' => PDO::PARAM_INT,
      'id_user' => PDO::PARAM_INT,
      'id_student' => PDO::PARAM_INT,
      'type' => PDO::PARAM_INT,
      'pieces' => PDO::PARAM_INT,            
    ];
  }

  public function AttributesForUpdate() {
    return [
      'id_loan' => PDO::PARAM_INT,
      'id_user' => PDO::PARAM_INT,
      'id_student' => PDO::PARAM_INT,
      'type' => PDO::PARAM_INT,
      'pieces' => PDO::PARAM_INT,
    ];
  }

  public function AttributesWithTimestamps() {
    return true;
  }

  public function IdUser() {
    return $this->id_user;
  }  

  public function IdStudent() {
    return $this->id_student;
  }

  public function Pieces() {
    return $this->pieces;
  } 

  public function Type() {
    return $this->type;
  }

  public function TypeName() {
    return $this->type == MOVE_TYPE_DELIVER ? "Entrega" : "Devolucion";
  }

  public function User(){
    if(empty($user)){
      $user = FetchUserWithID($this->id_user);
    }
    return $user;
  }

  public function Student(){
    if(empty($student)){
      $student = FetchstudentWithID($this->id_student);
    }
    return $student;
  }

  public function Valid() {     
    if (empty($this->id_user)) { return false; }   
    if (empty($this->id_student)) { return false; } 
    if (empty($this->id_loan)) { return false; }       
    if (empty($this->type)) { return false; }
    if (empty($this->pieces)) { return false; }
    return true;
  }
}

require_once(BASE_LIB_FOLDER . 'helpers/move_loan.php');
?>
