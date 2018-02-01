<?php

function LoansCount() {
  global $BASE;  

  try {
    $stmt = $BASE->DB()->query("SELECT COUNT(id) AS `counted` FROM `loans`;");
    $count = $stmt->fetch(PDO::FETCH_OBJ);
    $count = $count->counted;
  } catch(PDOException $e) {
    $count = 0;
    die($e->getMessage());
  }

  return $count;
}

function UpdateLoanForEdit($id_loan=0){
  global $BASE;  
  $algo = 0;
  try {
   
    $stmt = $BASE->DB()->prepare("UPDATE `loans` SET `status` = 0 WHERE `id` = :id_loan;");
    $stmt->bindParam(':id_loan', $id_loan, PDO::PARAM_INT);
    $stmt->execute();

  } catch(PDOException $e) {
    $count = 0;
    die($e->getMessage());
  }

}

function DeleteLoanForEdit($id_student=0){
  global $BASE;  
  $algo = 0;
  try {
   
    $stmt = $BASE->DB()->prepare("DELETE FROM `loans` WHERE `status` = 0 AND `id_student` = :id_student;");
    $stmt->bindParam(':id_student', $id_student, PDO::PARAM_INT);
    $stmt->execute();

  } catch(PDOException $e) {
    $count = 0;
    die($e->getMessage());
  }

  /*DELETE FROM loans WHERE status = 0 AND id_student = 3*/
}

function FetchLoansWithStudentId($page = 1, $per = 20, $search = "", $status = LOAN_STATUS_WAITING, $id_student=0){

  global $BASE;

  $page = intval($page);
  if ($page < 1) { $page = 1; }
  $offset = $per * ($page - 1);

  $search_numer = 0;
  if(!empty($search) && is_numeric($search))  
    $search_numer = (int) $search;

  try {        
    $stmt = $BASE->DB()->query("SELECT * FROM `loans` WHERE `status` = $status AND `id_student` IN (SELECT `id` FROM `users` WHERE `name` = '%$search%' OR `last_name` LIKE '%$search%' OR `created_at` LIKE '%$search%' OR `updated_at` LIKE '%$search%' OR `id` = $search_numer) AND `id_student` = $id_student OR (`id` = $search_numer AND `status` = $status) ORDER BY `id` DESC LIMIT $per OFFSET $offset;");        
    $results = $stmt->fetchAll(PDO::FETCH_CLASS, 'Loan');
    $results = new DBResults($results, $page, $per);
  } catch(PDOException $e) {
    $results = null;
    die($e->getMessage());
  }

  return $results;

}

function FetchAllLoans($page = 1, $per = 20, $search = "", $status = LOAN_STATUS_WAITING) {
  global $BASE;

  $page = intval($page);
  if ($page < 1) { $page = 1; }
  $offset = $per * ($page - 1);

  $search_numer = 0;
  if(!empty($search) && is_numeric($search))  
    $search_numer = (int) $search;

  try {        
    $stmt = $BASE->DB()->query("SELECT * FROM `loans` WHERE `status` = $status AND `id_student` IN (SELECT `id` FROM `users` WHERE `name` LIKE '%$search%' OR `last_name` LIKE '%$search%' OR `id` = $search_numer OR `enrollment` LIKE '%$search%' ) OR (`id` = $search_numer AND `status` = $status) ORDER BY `id` DESC LIMIT $per OFFSET $offset;");        
    $results = $stmt->fetchAll(PDO::FETCH_CLASS, 'Loan');
    $results = new DBResults($results, $page, $per);
  } catch(PDOException $e) {
    $results = null;
    die($e->getMessage());
  }

  return $results;
}

function FetchLoanWithID($id=0) {
  global $BASE;

  $user = null;

  try {
    $stmt = $BASE->DB()->prepare("SELECT * FROM `loans` WHERE `id` = :id LIMIT 1;");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    $stmt->execute();

    $user = $stmt->fetchObject('Loan');
  } catch(PDOException $e) {
    die($e->getMessage());
  }

  return $user;
}

/*function FetchLoansWithStudentId($id_student=0){
  global $BASE;
  $loads = null;

  try{
       $stmt = $BASE->DB()->prepare("SELECT * FROM `loans` WHERE `id_student` = :id_student");
    
    $stmt->bindParam(':id_student', $id_student, PDO::PARAM_INT);
    $stmt->execute();

    $loads = $stmt->fetchObject('Loan');
  } catch(PDOException $e) {
    die($e->getMessage());
  }

  return $loads;
}*/

/*function FetchLoansWithStudentId($id_student=0){
  global $BASE;
  $loads = null;

  try{
       $stmt = $BASE->DB()->prepare("SELECT * FROM `loans` WHERE `id_student` = :id_student");
    
    $stmt->bindParam(':id_student', $id_student, PDO::PARAM_INT);
    $stmt->execute();

    $loads = $stmt->fetchAll(PDO::FETCH_CLASS,'Loan');
  } catch(PDOException $e) {
    die($e->getMessage());
  }

  return $loads;
}*/

function FetchLoanWithStudent($id_student=0, $status = LOAN_STATUS_DRAFT) {
  global $BASE;

  $loan = null;

  try {
    $stmt = $BASE->DB()->prepare("SELECT * FROM `loans` WHERE `status` = :status AND `id_student` = :id_student LIMIT 1;");
    $stmt->bindParam(':status', $status, PDO::PARAM_INT);
    $stmt->bindParam(':id_student', $id_student, PDO::PARAM_INT);

    $stmt->execute();

    $loan = $stmt->fetchObject('Loan');
  } catch(PDOException $e) {
    die($e->getMessage());
  }

  return $loan;
}
?>