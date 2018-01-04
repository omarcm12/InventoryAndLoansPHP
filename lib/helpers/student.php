<?php

function FetchStudentWithID($id=0) {
  global $BASE;

  $student = null;

  try {
    $stmt = $BASE->DB()->prepare("SELECT * FROM `users` JOIN `students` ON `id` = `id_student`  AND `id`= :id LIMIT 1;");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    $stmt->execute();

    $student = $stmt->fetchObject('Student');
  } catch(PDOException $e) {
    die($e->getMessage());
  }

  return $student;
}

?>
