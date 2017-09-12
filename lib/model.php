<?php

if(count(get_included_files()) == 1) exit("Direct access not permitted.");

define('BASE_BLOG_DATE_FORMAT', '%b %d, %Y'); // Feb 15, 2015
define('BASE_FULL_DATE_FORMAT', '%Y-%m-%dT%H:%M:%S%z'); // 2015-02-13T12:46:11+00:00
define('BASE_SIMPLE_DATE_FORMAT', '%F %R'); // YYYY-MM-DD hh:mm

abstract class BaseModel {
  protected $id;

  protected $created_at;
  protected $updated_at;

  protected $db;
  protected $table_name;

  protected static $table_names;

  public function __construct() {
    global $BASE;

    $this->db = $BASE->DB();

    if (empty(static::$table_names)) {
      static::$table_names = [];
    }

    $this->table_name = static::tableName() ?: static::setTableName();
  }

  abstract public function AttributesForCreate();
  abstract public function AttributesForUpdate();

  public function AttributesWithTimestamps() {
    return false;
  }

  public function ID() {
    return intval($this->id);
  }

  public function CreatedAt() {
    return empty($this->created_at) ? null : strtotime($this->created_at);
  }

  public function CreatedAtFormatted($format = BASE_SIMPLE_DATE_FORMAT, $default = 'N/A') {
    return empty($this->created_at) ? $default : strftime($format, $this->CreatedAt());
  }

  public function IsPersisted() {
    return $this->ID() > 0;
  }

  public function IsUpdated() {
    return ($this->CreatedAt() < $this->UpdatedAt());
  }

  public function UpdatedAt() {
    return !empty($this->updated_at) ? strtotime($this->updated_at) : null;
  }

  public function UpdatedAtFormatted($format = BASE_SIMPLE_DATE_FORMAT, $default = 'N/A') {
    return empty($this->created_at) ? $default : strftime($format, $this->UpdatedAt());
  }

  public function Valid() {
    return true;
  }

  public function Create() {
    try {
      $query = 'INSERT INTO `' . $this->table_name . '` (' . $this->sqlForInsert() .') VALUES(' . $this->sqlForInsertValues() . ');';

      $this->db->beginTransaction();

      $stmt = $this->db->prepare($query);
      foreach ($this->AttributesForCreate() as $attribute => $type) {
        $stmt->bindParam(':'.$attribute, $this->$attribute, $type);
      }

      if ($stmt->execute()) {
        $result = true;
        $this->id = $this->db->lastInsertId();
      } else {
        $result = false;
        die($this->db->errorInfo());
      }
      $this->db->commit();
    } catch(PDOException $e) {
      $this->db->rollback();
      $result = false;
      die($e->getMessage());
    }

    return $result;
  }

  public function Update() {
    try {
      $query = 'UPDATE `' . $this->table_name . '` SET ' . $this->sqlForUpdate() . ' WHERE id = :id;';
      $this->db->beginTransaction();

      $stmt = $this->db->prepare($query);
      $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
      foreach ($this->AttributesForUpdate() as $attribute => $type) {
        $stmt->bindParam(':'.$attribute, $this->$attribute, $type);
      }

      if ($stmt->execute()) {
        $result = true;
      } else {
        $result = false;
        die($this->db->errorInfo());
      }
      $this->db->commit();
    } catch(PDOException $e) {
      $this->db->rollback();
      $result = false;
      die($e->getMessage());
    }

    return $result;
  }

  public function Destroy() {
    try {
      $query = 'DELETE FROM `' . $this->table_name . '` WHERE id = :id;';

      $this->db->beginTransaction();

      $stmt = $this->db->prepare($query);
      $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

      if ($stmt->execute()) {
        $result = true;
      } else {
        $result = false;
        die($this->db->errorInfo());
      }
      $this->db->commit();
    } catch(PDOException $e) {
      $this->db->rollback();
      $result = false;
      die($e->getMessage());
    }

    return $result;
  }

  private static function tableName() {
    return @static::$table_names[get_called_class()];
  }

  private static function setTableName() {
    $model = get_called_class();
    static::$table_names[$model] = Inflect::pluralize(modelTableize($model));

    return static::$table_names[$model];
  }

  private function sqlForInsert() {
    $attrs = array_keys($this->AttributesForCreate());
    if ($this->AttributesWithTimestamps()) { $attrs[] = 'created_at'; }
    array_map('modelBackTicksForAttribute', $attrs);
    return join(',', $attrs);
  }

  private function sqlForInsertValues() {
    $attrs = array_keys($this->AttributesForCreate());
    $attrs = array_map('modelColonForAttribute', $attrs);
    if ($this->AttributesWithTimestamps()) { $attrs[] = 'CURRENT_TIMESTAMP'; }
    return join(',', $attrs);
  }

  private function sqlForUpdate() {
    $attrs = array_keys($this->AttributesForUpdate());
    $attrs = array_map('modelUpdateSyntaxForAttribute', $attrs);
    return join(',', $attrs);
  }
}

require_once(BASE_LIB_FOLDER . 'helpers/model.php');

?>
