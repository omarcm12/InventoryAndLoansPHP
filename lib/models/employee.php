<?php

if(count(get_included_files()) == 1) exit("Direct access not permitted.");

define('USER_ADMIN', 0);
define('USER_STUDENT', 1);
define('USER_SERVICE', 2);

class Employee extends User {
  public $num_employee;
  

  public function NumEmployee(){
    return $this->num_employee;
  }


}

require_once(BASE_LIB_FOLDER . 'helpers/user.php');
?>
