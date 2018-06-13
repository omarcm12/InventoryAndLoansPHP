<?php

function FetchStudentWithID($id=0) {
  global $BASE;

  $student = null;

  try {
    $stmt = $BASE->DB()->prepare("SELECT * FROM `users` WHERE `id` = :id  AND `type`=  1 OR `type` = 2;");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    $stmt->execute();

    $student = $stmt->fetchObject('User');
  } catch(PDOException $e) {
    die($e->getMessage());
  }

  return $student;
}


function FetchAllStudents($page=1, $per=20, $search = ""){
  //SELECT * FROM `users` join (student) on (users.id = student.id)
  global $BASE;
  $page = intval($page);
  if ($page < 1) { $page = 1; }

  $offset = $per * ($page - 1);
  $students = null;

  try{
       $stmt = $BASE->DB()->query("SELECT * FROM `users` WHERE `type` = 1 OR `type` = 2 AND `id` IN (SELECT `id` FROM `users` WHERE `name` LIKE '%$search%' OR `last_name` LIKE '%$search%' OR `carrer` LIKE '%$search%' OR `enrollment` LIKE '%$search%' OR `email` LIKE '%$search%') ORDER BY `id` DESC LIMIT $per OFFSET $offset" );
    
   // $stmt->bindParam(':id_student', $id_student, PDO::PARAM_INT);
    $results = $stmt->fetchAll(PDO::FETCH_CLASS, 'User');
    $results = new DBResults($results, $page, $per);
  } catch(PDOException $e) {
    die($e->getMessage());
  }

  return $results;
}


function UpdateInfoStudent($name, $last_name, $enrollment, $carrer, $semester){
  $table_name = "users";
  global $BASE;
  //$query = 'UPDATE users INNER JOIN students ON users.id  = students.id_students SET users.name =`' . $name . '` WHERE users.id = 2';
  try{
    //$BASE->DB->prepare($query);
    /*$stmt = $BASE->DB()->prepare("UPDATE `users` INNER JOIN `students` ON `id` = `id_student` SET `name` = `.' $name '.` WHERE `id`=:id LIMIT 1;");*/
    $stmt = $BASE->DB()->prepare("UPDATE `users` JOIN `students` ON `is` = `is_student` SET `name` = :name AND `id` = :id");
    $stmt->execute();


  } catch(PDOException $e){
    die($e->getMessage());
  }
  return;
}

/*
UPDATE users INNER JOIN students ON users.id = students.id_students SET users.name = 'Jose', users.last_name = 'Perez', students.carrer = 'quimico industrial', students.semester = 5, students.enrollment = 566666 WHERE users.id = 2
*/

?>
