<?php

if(count(get_included_files()) == 1) exit("Direct access not permitted.");

class DBConfig {
  private $db;
  private $db_type;
  private $tz_offset;

  public function __construct($tz) {
    $this->setDBType();
    $this->setTimezoneOffset($tz);
  }

  public function Connect($db_host, $db_name, $db_user, $db_pass) {
    $this->db = null;
    try {
      switch ($this->db_type) {
        case 1:
          $this->db = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8;", $db_user, $db_pass, array(PDO::ATTR_PERSISTENT => true, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
          $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $this->db->exec("SET time_zone = '" . $this->TimeZoneOffset() . "';");
          $this->db->exec('SET NAMES utf8');
          break;
        default:
          break;
      }
    } catch(PDOException $e) {
      $this->db = null;
      // die($e->getMessage());
    }

    return $this->db;
  }

  public function Close() {
    $this->db = null;
  }

  public function DBType() {
    return $this->db_type;
  }

  private function setDBType() {
    $this->db_type = 0;
    $drivers = PDO::getAvailableDrivers();
    if (in_array('mysql', $drivers)) {
      $this->db_type = 1;
    } else {
      global $BASE;

      $BASE->Response()->ExitWithError('Unsupported DB', 'PDO Driver for MySQL unavailable.');
    }
  }

  private function setTimezoneOffset($tz) {
    date_default_timezone_set($tz);

    $now = new DateTime();
    $mins = $now->getOffset() / 60;

    $sgn = ($mins < 0) ? -1 : 1;
    $mins = abs($mins);
    $hrs = floor($mins / 60);
    $mins -= $hrs * 60;

    $this->tz_offset = sprintf('%+d:%02d', $hrs * $sgn, $mins);
  }

  public function TimeZoneOffset() {
    return $this->tz_offset;
  }
}

require_once(BASE_LIB_FOLDER . 'helpers/db_results.php');

?>
