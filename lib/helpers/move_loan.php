<?php
function FetchMoveLoanWithID($id=0) {
  global $BASE;

  $moveLoan = null;

  try {
    $stmt = $BASE->DB()->prepare("SELECT * FROM `move_loans` WHERE `id` = :id LIMIT 1;");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    $stmt->execute();

    $moveLoan = $stmt->fetchObject('MoveLoan');
  } catch(PDOException $e) {
    die($e->getMessage());
  }

  return $moveLoan;
}

function MoveLoansCount() {
  global $BASE;  

  try {
    $stmt = $BASE->DB()->query("SELECT COUNT(id) AS `counted` FROM `move_loans`;");
    $count = $stmt->fetch(PDO::FETCH_OBJ);
    $count = $count->counted;
  } catch(PDOException $e) {
    $count = 0;
    die($e->getMessage());
  }

  return $count;
}

function FetchAllMoveLoans($page = 1, $per = 20, $search = "") {
  global $BASE;

  $page = intval($page);
  if ($page < 1) { $page = 1; }

  $offset = $per * ($page - 1);

  try {
    $stmt = $BASE->DB()->query("SELECT * FROM `move_loans` WHERE `id_loan` LIKE '%$search%' OR `id_student` IN (SELECT `id` FROM `users` WHERE `name` LIKE '%$search%') ORDER BY `id` DESC LIMIT $per OFFSET $offset;");
    $results = $stmt->fetchAll(PDO::FETCH_CLASS, 'MoveLoan');
    $results = new DBResults($results, $page, $per);
  } catch(PDOException $e) {
    $results = null;
    die($e->getMessage());
  }

  return $results;
}
?>