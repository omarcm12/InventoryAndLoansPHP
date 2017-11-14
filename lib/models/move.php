<?php

if(count(get_included_files()) == 1) exit("Direct access not permitted.");

define('MOVE_TYPE_REMOVE', 0);
define('MOVE_TYPE_ADD', 1);

class Move extends BaseModel {
  public $id_user;
  public $type;
  public $no_order;  
  public $description;
  public $pieces;


  public function AttributesForCreate() {
    return [   
      'id_user' => PDO::PARAM_STR,
      'type' => PDO::PARAM_STR,
      'no_order' => PDO::PARAM_STR,
      'description' => PDO::PARAM_STR,
      'pieces' => PDO::PARAM_STR,
               
    ];
  }

  public function AttributesForUpdate() {
    return [
      'id_user' => PDO::PARAM_STR,
      'type' => PDO::PARAM_STR,
      'no_order' => PDO::PARAM_STR
    ];
  }

  public function AttributesWithTimestamps() {
    return true;
  }

  public function IdUser() {
    return $this->id_user;
  }  

  public function Pieces() {
    return $this->pieces;
  } 

  public function Type() {
    return $this->type;
  }

  public function NoOrder() {
    return $this->no_order;
  }

  public function Description(){
    return $this->description;
  }


  public function Valid() {     
    if (empty($this->id_user)) { return false; }    
    if (empty($this->type)) { return false; }
    if (empty($this->no_order)) { return false; }       
    if (empty($this->pieces)) { return false; }

    return true;
  }

}



require_once(BASE_LIB_FOLDER . 'helpers/move.php');
?>
