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

function CountWithIDStudent($id=0){
  global $BASE;
  try {
    $stmt = $BASE->DB()->prepare("SELECT `id` FROM `loans` WHERE `id_student` = :id AND `status` = 2;");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    //$stmt->execute();
    $stmt->execute();
    //$stmt->store_result();
    $count = $stmt->rowCount();
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



function DaysCount($age=0){
    
  $now = time();
  $days=0;
  while($age<$now){
      $var = date("D",$age);
      if($var != "Sar" && $var != "Sun"){
          $days++;
      }
      $age = $age+86400;
  }

  return $days;
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

function FetchAgeCaduce($MaxDias=3){
  //Esta pequeña funcion me crea una fecha de entrega sin sabados ni domingos  
    $now = time();
    $Segundos = 0;
    $fechaInicial = mktime(0,0,0,date("m",$now), date("d",$now), date("Y",$now));//date("Y-m-d"); //obtenemos la fecha de hoy, solo para usar como referencia al usuario  

         for ($i=0; $i<$MaxDias; $i++)  
          {  
                        //Acumulamos la cantidad de segundos que tiene un dia en cada vuelta del for  
              $Segundos = $Segundos + 86400;  
                
                        //Obtenemos el dia de la fecha, aumentando el tiempo en N cantidad de dias, segun la vuelta en la que estemos  
              //$caduca = time()+$Segundos;//date("D",time()+$Segundos);  
              $caduca = $fechaInicial+$Segundos;
              $var = date("D",$caduca);
                                 //Comparamos si estamos en sabado o domingo, si es asi restamos una vuelta al for, para brincarnos el o los dias...  
                  if ($var == "Sat")  
                  {  
                      $i--;  
                  }  
                  else if ($var == "Sun")  
                  {  
                      $i--;  
                  }  
                  else  
                  {  
                                          //Si no es sabado o domingo, y el for termina y nos muestra la nueva fecha  
                      $FechaFinal = $fechaInicial+$Segundos;  
                  }  
          }  

          return $FechaFinal;
}


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