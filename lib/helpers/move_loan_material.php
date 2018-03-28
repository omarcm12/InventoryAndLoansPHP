<?php

function FetchMoveLoanMaterialWithID($id=0) {
  global $BASE;

  $user = null;

  try {
    $stmt = $BASE->DB()->prepare("SELECT * FROM `move_loan_materials` WHERE `id` = :id LIMIT 1;");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    $stmt->execute();

    $user = $stmt->fetchObject('MoveLoanMaterial');
  } catch(PDOException $e) {
    die($e->getMessage());
  }

  return $user;
}

function FetchMoveLoanMaterialWithMoveLoanID($id_Moveloan=0) {
  global $BASE;

  try {
    $stmt = $BASE->DB()->query("SELECT * FROM `move_loan_materials` WHERE `id_move_loan` = $id_Moveloan;");
    $results = $stmt->fetchAll(PDO::FETCH_CLASS, 'MoveLoanMaterial');    
  } catch(PDOException $e) {
    $results = null;
    die($e->getMessage());
  }

  return $results;
}


?>