<?php

if(count(get_included_files()) == 1) exit("Direct access not permitted.");

define('USER_ADMIN', 0);
define('USER_STUDENT', 1);
define('USER_SERVICE', 2);

class Student extends User {
  public $enrollment;
  public $carrer;
  public $semester;


  public function Carrer() {
    return $this->carrer;
  }

  public function Semester() {
    return $this->semester;
  }

  public function Enrollment() {
    return $this->enrollment;
  }
}
require_once(BASE_LIB_FOLDER . 'helpers/student.php');
?>
