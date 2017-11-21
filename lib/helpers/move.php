<?php
function FetchMoveWithID($id=0) {
  global $BASE;

  $move = null;

  try {
    $stmt = $BASE->DB()->prepare("SELECT * FROM `moves` WHERE `id` = :id LIMIT 1;");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    $stmt->execute();

    $move = $stmt->fetchObject('Move');
  } catch(PDOException $e) {
    die($e->getMessage());
  }

  return $move;
}

function MovesCount() {
  global $BASE;  

  try {
    $stmt = $BASE->DB()->query("SELECT COUNT(id) AS `counted` FROM `moves`;");
    $count = $stmt->fetch(PDO::FETCH_OBJ);
    $count = $count->counted;
  } catch(PDOException $e) {
    $count = 0;
    die($e->getMessage());
  }

  return $count;
}

function FetchAllMoves($page = 1, $per = 20, $search = "") {
  global $BASE;

  $page = intval($page);
  if ($page < 1) { $page = 1; }

  $offset = $per * ($page - 1);

  try {
    $stmt = $BASE->DB()->query("SELECT * FROM `moves` WHERE `no_order` LIKE '%$search%' OR `id_material` IN (SELECT `id` FROM `materials` WHERE `name` LIKE '%$search%') OR `id_material` IN (SELECT `id` FROM `materials` WHERE `catalog_number` LIKE '%$search%') ORDER BY `id` DESC LIMIT $per OFFSET $offset;");
    $results = $stmt->fetchAll(PDO::FETCH_CLASS, 'Move');
    $results = new DBResults($results, $page, $per);
  } catch(PDOException $e) {
    $results = null;
    die($e->getMessage());
  }

  return $results;
}
?>