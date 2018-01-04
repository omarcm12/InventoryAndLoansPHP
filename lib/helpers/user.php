<?php

function UsersCount() {
  global $BASE;  

  try {
    $stmt = $BASE->DB()->query("SELECT COUNT(id) AS `counted` FROM `users`;");
    $count = $stmt->fetch(PDO::FETCH_OBJ);
    $count = $count->counted;
  } catch(PDOException $e) {
    $count = 0;
    die($e->getMessage());
  }

  return $count;
}

function FetchUsers($page = 1, $per = 20) {
  global $BASE;

  $page = intval($page);
  if ($page < 1) { $page = 1; }

  $offset = $per * ($page - 1);

  try {
    $stmt = $BASE->DB()->query("SELECT * FROM `users` ORDER BY `id` DESC LIMIT $per OFFSET $offset;");
    $results = $stmt->fetchAll(PDO::FETCH_CLASS, 'User');
    $results = new DBResults($results, $page, $per);
  } catch(PDOException $e) {
    $results = null;
    die($e->getMessage());
  }

  return $results;
}

function FetchUserWithID($id=0) {
  global $BASE;

  $user = null;

  try {
    $stmt = $BASE->DB()->prepare("SELECT * FROM `users` WHERE `id` = :id LIMIT 1;");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    $stmt->execute();

    $user = $stmt->fetchObject('User');
  } catch(PDOException $e) {
    die($e->getMessage());
  }

  return $user;
}

function FetchUserWithEmail($email='') {
  global $BASE;

  $user = null;
  $email = mb_strtolower($email);  
  try {
    $stmt = $BASE->DB()->prepare("SELECT * FROM `users` WHERE `email` = :email LIMIT 1;");
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);

    $stmt->execute();

    $user = $stmt->fetchObject('User');
  } catch(PDOException $e) {
    die($e->getMessage());
  }

  return $user;
}

function userSlugFromName($name) {
  $slug=trim(preg_replace('/[^a-z0-9-]+/', '-', normalizeUTF8String(mb_strtolower($name))), '-');
  return $slug;
}

function imagesUploadFolderIsWriteable() {
  return is_writable(BASE_UPLOADS_FOLDER);
}



?>
