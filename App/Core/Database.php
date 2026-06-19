<?php 


namespace App\Core;

class Database {
  private static $conn;
  private static $iniFile = "config.ini";
  
  public function __construct() {
    try{
      if(!file_exists($iniFile)) {
        die("Error: O arquivo de configuracao nao foi encontrado.\n");
      }
      
      $config = parse_file($iniFile, true);
      if(!isset($config["database"]["database_path"])) {
        die("Error: Nao foi determiando o banco de dados a ser conectado dentro do arquivo de configuracao");
      }

      $dbPath = $config["database"]["database_path"];
      $dir = dirname($dbPath);

      if (!is_dir($dir) && !empty($dir) && $dir !== '.') {
          mkdir($dir, 0755, true);
      }


      self::$conn = new PDO("sqlite:" . $dbPath);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
      
      echo "Conexão com o SQLite realizada com sucesso!\n";





    }catch(PDOException $e){
      echo "Erro ao tentar se conectar com o banco de dados" . $e->getMessage() . "\n";
    }
  }

  public static function _getConnection(): PDO {
    return self::$conn;
  }
} 


?>