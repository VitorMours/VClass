<?php 

class Database {

  private static $conn;

  public function __construct() {
  }

  public static function _getConnection(): PDO {
    return self::$conn;
  }
} 


?>