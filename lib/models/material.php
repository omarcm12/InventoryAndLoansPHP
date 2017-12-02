<?php

if(count(get_included_files()) == 1) exit("Direct access not permitted.");

define('MATERIAL_STATUS_NORMAL', 0);
define('MATERIAL_STATUS_OVERAGE', 1);
define('MATERIAL_STATUS_SHORTAGE', 2);

define('MATERIAL_SORT_CATALOG', 0); // default
define('MATERIAL_SORT_NAME', 1);
define('MATERIAL_SORT_STATUS', 2);

class Material extends BaseModel {
  public $name;
  public $description;
  public $catalog_number;
  public $stock_count;
  public $stock_min;
  public $stock_max;  
  public $borrowed_count;  
  public $total_count;  
  public $price_per_unit;  
  public $image_path;   

  public function AttributesForCreate() {
    return [
      'name' => PDO::PARAM_STR, 
      'description' => PDO::PARAM_STR,      
      'catalog_number' => PDO::PARAM_STR,
      'stock_count' => PDO::PARAM_INT,
      'stock_min' => PDO::PARAM_INT,
      'stock_max' => PDO::PARAM_INT,
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

  public function CatalogNumber(){
    return $this->catalog_number;
  }

  public function BorrowedCount(){
    return $this->borrowed_count;
  }

  public function Name(){
    return $this->name;
  }

  public function Description(){
    return $this->description;
  }

  public function StockCount(){
    return $this->stock_count;
  }

  public function StockMin(){
    return $this->stock_min;
  }

  public function StockMax(){
    return $this->stock_max;
  }

  public function PricePerUnit(){
    return $this->price_per_unit;
  }

  public function TotalCount(){
    return $this->total_count;
  }

  public function StatusName(){
    $status = "Normal";
    if($this->total_count < $this->stock_min){
      $status = "Escaso";
    }else if($this->total_count > $this->stock_max){
      $status = "Exceso";
    }
    return $status;
  }

  public function StatusLabel(){
    $status = "normal";
    if($this->total_count < $this->stock_min){
      $status = "danger";
    }else if($this->total_count > $this->stock_max){
      $status = "overage";
    }
    return $status;
  }

  public function Valid() {
    if (empty($this->name)) { return false; }  
    if (empty($this->total_count)) { return false; }  
    return true;
  }

  public function ImagePath() {
    return $this->image_path;
  }

  public function Folder() {
    return 'catalog/' . $this->ID() . '/';
  }

  public function LocalPath() {
    return BASE_UPLOADS_FOLDER . $this->Folder() . $this->ImagePath();
  }

  public function Path() {
    if (empty($this->image_path)) { return BASE_IMAGE_ASSETS_PATH . 'chemistry.png'; }
    
    return BASE_UPLOADS_PATH . $this->Folder() . rawurlencode($this->ImagePath());
  }  
}

require_once(BASE_LIB_FOLDER . 'helpers/material.php');
?>
