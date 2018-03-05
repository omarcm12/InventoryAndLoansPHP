<?php
function FetchPenaltyWithID($id=0) {
  global $BASE;

  $penalty = null;

  try {
    $stmt = $BASE->DB()->prepare("SELECT * FROM `penalty_material` WHERE `id` = :id LIMIT 1;");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    $stmt->execute();

    $penalty = $stmt->fetchObject('Penalty_material');
  } catch(PDOException $e) {
    die($e->getMessage());
  }

  return $penalty;
}

function FetchAllPenaltys($page = 1, $per = 20, $search = "", $sort = 0) {
  global $BASE;
  $page = intval($page);
  if ($page < 1) { $page = 1; }

  $offset = $per * ($page - 1);

  try {
    $stmt = $BASE->DB()->query("SELECT * FROM `penalty_material` WHERE `id` LIKE '%$search%' OR `id_material` LIKE '%$search%' OR `id_student` LIKE '%$search%' LIMIT $per OFFSET $offset;");
    $results = $stmt->fetchAll(PDO::FETCH_CLASS, 'Penalty_material');
    $results = new DBResults($results, $page, $per);
  } catch(PDOException $e) {
    $results = null;
    die($e->getMessage());
  }

  return $results;
}

function FetchPenaltysWithIDStudent($page = 1, $per = 20, $search = "", $sort = 0, $id=0) {
  global $BASE;
  $page = intval($page);
  if ($page < 1) { $page = 1; }

  $offset = $per * ($page - 1);

  try {
    $stmt = $BASE->DB()->query("SELECT * FROM `penalty_material` WHERE `id_student` = $id AND  `id_material` LIKE '%$search%' LIMIT $per OFFSET $offset;");
    $results = $stmt->fetchAll(PDO::FETCH_CLASS, 'Penalty_material');
    $results = new DBResults($results, $page, $per);
  } catch(PDOException $e) {
    $results = null;
    die($e->getMessage());
  }

  return $results;
}


function PenaltysCount() {
  global $BASE;  

  try {
    $stmt = $BASE->DB()->query("SELECT COUNT(id) AS `counted` FROM `penalty_material`;");
    $count = $stmt->fetch(PDO::FETCH_OBJ);
    $count = $count->counted;
  } catch(PDOException $e) {
    $count = 0;
    die($e->getMessage());
  }

  return $count;
}


?>