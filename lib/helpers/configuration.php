<?php 

	function FetchConfiguration($id=0) {
	  global $BASE;

	  $configuration = null;

	  try {
	    $stmt = $BASE->DB()->prepare("SELECT * FROM `configurations` LIMIT 1;");
	    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

	    $stmt->execute();

	    $configuration = $stmt->fetchObject('Configuration');
	  } catch(PDOException $e) {
	    die($e->getMessage());
	  }

	  return $configuration;
	}


 ?>