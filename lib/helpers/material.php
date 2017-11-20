<?php
function FetchMaterialWithID($id=0) {
  global $BASE;

  $material = null;

  try {
    $stmt = $BASE->DB()->prepare("SELECT * FROM `materials` WHERE `id` = :id LIMIT 1;");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    $stmt->execute();

    $material = $stmt->fetchObject('Material');
  } catch(PDOException $e) {
    die($e->getMessage());
  }

  return $material;
}

function MaterialsCount() {
  global $BASE;  

  try {
    $stmt = $BASE->DB()->query("SELECT COUNT(id) AS `counted` FROM `materials`;");
    $count = $stmt->fetch(PDO::FETCH_OBJ);
    $count = $count->counted;
  } catch(PDOException $e) {
    $count = 0;
    die($e->getMessage());
  }

  return $count;
}

function FetchAllMaterials($page = 1, $per = 20, $search = "", $sort = 0) {
  global $BASE;
  $page = intval($page);
  if ($page < 1) { $page = 1; }

  $offset = $per * ($page - 1);

  try {
    $stmt = $BASE->DB()->query("SELECT *, 
      (CASE
        WHEN `total_count` < `stock_min` THEN 2
        WHEN `total_count` > `stock_max` THEN 1
        ELSE 0
      END) as `status`
      FROM `materials` WHERE `name` LIKE '%$search%' OR `catalog_number` LIKE '%$search%' ". SortParamsMaterial($sort). " LIMIT $per OFFSET $offset;");
    $results = $stmt->fetchAll(PDO::FETCH_CLASS, 'Material');
    $results = new DBResults($results, $page, $per);
  } catch(PDOException $e) {
    $results = null;
    die($e->getMessage());
  }

  return $results;
}

function SortParamsMaterial($id){
  $sorts = array("catalog_number", "name", "status");  
  $sortType = $id & 0x1 == 1 ? "DESC" : "ASC";
  return "ORDER BY `" . $sorts[ ($id >> 1) & 0x3] . "` " . $sortType;
}
?>