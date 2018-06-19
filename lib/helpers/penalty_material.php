<?php
function FetchPenaltyWithID($id=0) {
  global $BASE;

  $penalty = null;

  try {
    $stmt = $BASE->DB()->prepare("SELECT * FROM `penalty_materials` WHERE `id` = :id LIMIT 1;");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    $stmt->execute();

    $penalty = $stmt->fetchObject('Penalty_material');
  } catch(PDOException $e) {
    die($e->getMessage());
  }

  return $penalty;
}

function FetchPenaltyWithIDLoanMaterial($id=0){

  global $BASE;

  $penalty = null;

  try {
    $stmt = $BASE->DB()->prepare("SELECT * FROM `penalty_materials` WHERE `id_loan_material` = :id LIMIT 1;");
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
    $stmt = $BASE->DB()->query("SELECT * FROM `penalty_materials` WHERE `id` LIKE '%$search%' OR `id_material` LIKE '%$search%' OR `id_student` LIKE '%$search%' LIMIT $per OFFSET $offset;");
    $results = $stmt->fetchAll(PDO::FETCH_CLASS, 'Penalty_material');
    $results = new DBResults($results, $page, $per);
  } catch(PDOException $e) {
    $results = null;
    die($e->getMessage());
  }

  return $results;
}

function FetchPossiblePenaltys($page = 1, $per = 20, $search = "", $sort = 0) {
  global $BASE;
  $page = intval($page);
  if ($page < 1) { $page = 1; }

  $offset = $per * ($page - 1);
  try {
    $stmt = $BASE->DB()->query("SELECT loan_materials.id, loan_materials.id_loan,loan_materials.id_material, loan_materials.amount, loan_materials.deliver_at, loan_materials.return_at, loan_materials.returned_amount, loan_materials.description, loan_materials.return_unix FROM `loan_materials` LEFT JOIN `loans` ON loans.id = loan_materials.id_loan WHERE loans.status = '2'");
    $results = $stmt->fetchAll(PDO::FETCH_CLASS, 'LoanMaterial');

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
    $stmt = $BASE->DB()->query("SELECT * FROM `penalty_materials` WHERE `id_student` = $id AND `status` = 1 AND  `id_material` LIKE '%$search%' LIMIT $per OFFSET $offset;");
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
    $stmt = $BASE->DB()->query("SELECT COUNT(id) AS `counted` FROM `penalty_materials`;");
    $count = $stmt->fetch(PDO::FETCH_OBJ);
    $count = $count->counted;
  } catch(PDOException $e) {
    $count = 0;
    die($e->getMessage());
  }

  return $count;
}

function FetchDaysPenalty($age=0){
  $days = 0;
  $secconds = 0;
  $now = time();
  $now = mktime(0,0,0,date("m",$now), date("d",$now), date("Y",$now));  //php7.1.x
  //;
  //$now = time();
  while($now >=  $age){
    $var = date("D",$age);
    if($var != "Sat" && $var !="Sun"){
      $days++;
    } 
    $age = $age + 86400;  //one day is 86400 secconds
  }
 // $days = (time() - strtotime($age))/86400;
  
  return $days;
}

?>