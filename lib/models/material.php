<?php

if(count(get_included_files()) == 1) exit("Direct access not permitted.");


class Material extends BaseModel {
  public $name;
  public $catalog_number;
  public $stock_count;  
  public $borrowed_count;  
  public $total_count;  
  public $price_per_unit;  
  public $image_path;  

  public function AttributesForCreate() {
    return [
      'name' => PDO::PARAM_STR,      
      'catalog_number' => PDO::PARAM_STR,
      'stock_count' => PDO::PARAM_INT,
      'borrowed_count' => PDO::PARAM_INT,
      'total_count' => PDO::PARAM_INT,
      'price_per_unit' => PDO::PARAM_INT,  
      'image_path' => PDO::PARAM_STR       
    ];
  }

  public function AttributesForUpdate() {
    return $this->AttributesForCreate();
  }

  public function AttributesWithTimestamps() {
    return true;
  }

  public function Valid() {
    if (empty($this->name)) { return false; }  
    return true;
  }
}

require_once(BASE_LIB_FOLDER . 'helpers/material.php');
?>
