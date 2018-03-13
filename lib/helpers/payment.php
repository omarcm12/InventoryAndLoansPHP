<?php
function FetchPaymentWithID($id=0) {
  global $BASE;

  $payment = null;

  try {
    $stmt = $BASE->DB()->prepare("SELECT * FROM `payments` WHERE `id` = :id LIMIT 1;");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    $stmt->execute();

    $penalty = $stmt->fetchObject('Payment');
  } catch(PDOException $e) {
    die($e->getMessage());
  }

  return $penalty;
}

function FetchAllPayments($page = 1, $per = 20, $search = "", $sort = 0) {
  global $BASE;
  $page = intval($page);
  if ($page < 1) { $page = 1; }

  $offset = $per * ($page - 1);

  try {
    $stmt = $BASE->DB()->query("SELECT * FROM `payments` WHERE `id` LIKE '%$search%' OR `id_penalty` LIKE '%$search%' OR `id_student` LIKE '%$search%' LIMIT $per OFFSET $offset;");
    $results = $stmt->fetchAll(PDO::FETCH_CLASS, 'Payment');
    $results = new DBResults($results, $page, $per);
  } catch(PDOException $e) {
    $results = null;
    die($e->getMessage());
  }

  return $results;
}

function FetchPaymentsWithIDStudent($page = 1, $per = 20, $search = "", $sort = 0, $id=0) {
  global $BASE;
  $page = intval($page);
  if ($page < 1) { $page = 1; }

  $offset = $per * ($page - 1);

  try {
    $stmt = $BASE->DB()->query("SELECT * FROM `payments` WHERE `id_student` = $id AND  `id_penalty` LIKE '%$search%' LIMIT $per OFFSET $offset;");
    $results = $stmt->fetchAll(PDO::FETCH_CLASS, 'Payment');
    $results = new DBResults($results, $page, $per);
  } catch(PDOException $e) {
    $results = null;
    die($e->getMessage());
  }

  return $results;
}


function PaymentsCount() {
  global $BASE;  

  try {
    $stmt = $BASE->DB()->query("SELECT COUNT(id) AS `counted` FROM `payments`;");
    $count = $stmt->fetch(PDO::FETCH_OBJ);
    $count = $count->counted;
  } catch(PDOException $e) {
    $count = 0;
    die($e->getMessage());
  }

  return $count;
}


?>