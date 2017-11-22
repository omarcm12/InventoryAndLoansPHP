<?php

function FetchLoanMaterialWithID($id=0) {
  global $BASE;

  $user = null;

  try {
    $stmt = $BASE->DB()->prepare("SELECT * FROM `loan_materials` WHERE `id` = :id LIMIT 1;");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    $stmt->execute();

    $user = $stmt->fetchObject('LoanMaterial');
  } catch(PDOException $e) {
    die($e->getMessage());
  }

  return $user;
}

function FetchLoanMaterialWithLoanID($id_loan=0) {
  global $BASE;

  try {
    $stmt = $BASE->DB()->query("SELECT * FROM `loan_materials` WHERE `id_loan` = $id_loan;");
    $results = $stmt->fetchAll(PDO::FETCH_CLASS, 'LoanMaterial');    
  } catch(PDOException $e) {
    $results = null;
    die($e->getMessage());
  }

  return $results;
}


?>