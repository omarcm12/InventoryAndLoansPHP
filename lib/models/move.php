<?php

if(count(get_included_files()) == 1) exit("Direct access not permitted.");


class Move extends BaseModel {
  public $catalog_number_material;
  public $id_user;
  public $type;
  public $no_order;  
  public $description;
  public $pieces;
  public $name_material;


  public function AttributesForCreate() {
    return [
      'catalog_number_material' => PDO::PARAM_STR,      
      'id_user' => PDO::PARAM_STR,
      'type' => PDO::PARAM_STR,
      'no_order' => PDO::PARAM_STR,
      'description' => PDO::PARAM_STR,
      'pieces' => PDO::PARAM_STR,
      'name_material' => PDO::PARAM_STR                  
    ];
  }

  public function AttributesForUpdate() {
    return [
      'catalog_number_material' => PDO::PARAM_STR,      
      'id_user' => PDO::PARAM_STR,
      'type' => PDO::PARAM_STR,
      'no_order' => PDO::PARAM_STR
    ];
  }

  public function AttributesWithTimestamps() {
    return true;
  }

  public function CatalogNumberMaterial() {
    return $this->catalog_number_material;
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

  public function NameMaterial(){
    return $this->name_material;
  }

  public function Valid() {
    if (empty($this->catalog_number_material)) { return false; }       
    //if (empty($this->id_user)) { return false; }    
    if (empty($this->type)) { return false; }
    if (empty($this->no_order)) { return false; }       

    return true;
  }

}



require_once(BASE_LIB_FOLDER . 'helpers/move.php');
?>
