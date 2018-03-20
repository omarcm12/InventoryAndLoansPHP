<?php

if(count(get_included_files()) == 1) exit("Direct access not permitted.");

define('MOVE_TYPE_REMOVE', 0);
define('MOVE_TYPE_ADD', 1);

class Move extends BaseModel {
  public $id_material;
  public $id_user;
  public $type;
  public $no_order;  
  public $description;
  public $pieces;

  private $material;
  private $user;

  public function AttributesForCreate() {
    return [   
      'id_material' => PDO::PARAM_INT,
      'id_user' => PDO::PARAM_INT,
      'type' => PDO::PARAM_STR,
      'no_order' => PDO::PARAM_STR,
      'description' => PDO::PARAM_STR,
      'pieces' => PDO::PARAM_STR,
               
    ];
  }

  public function AttributesForUpdate() {
    return [
      'id_user' => PDO::PARAM_INT,
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

  public function Age() {
    return strftime('%d-%m-%Y',strtotime($this->created_at));
  } 

  public function TypeName() {
    return $this->type == MOVE_TYPE_ADD ? "Alta" : "Baja";
  }

  public function NoOrder() {
    return $this->no_order;
  }

  public function Description(){
    return $this->description;
  }

  public function Material(){
    if(empty($material)){
      $material = FetchMaterialWithID($this->id_material);
    }
    return $material;
  }

  public function User(){
    if(empty($user)){
      $user = FetchUserWithID($this->id_user);
    }
    return $user;
  }

  public function Valid() {     
    if (empty($this->id_user)) { return false; }    
    if (empty($this->no_order)) { return false; }       
    if (empty($this->pieces)) { return false; }
    if (empty($this->id_material)) { return false; }
    return true;
  }
}

require_once(BASE_LIB_FOLDER . 'helpers/move.php');
?>
