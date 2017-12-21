<?php

namespace App\Components;

use App\Loader;
use PDO;

class DbComponent
{

  protected static $instance = null;

  public static function getInstance()
  {
    if( self::$instance === null ) {
      self::$instance = new DbComponent;
    }
    return self::$instance;
  }

  protected function __construct() {}

  function __destruct() {}

  public function getDb()
  {
    $conn = null;
    $data = Loader::getContainer()['settings']['mysql'];

    $dsn = sprintf('mysql:host=%s;dbname=%s',$data['host'], $data['database']);

    try {
      $conn = new PDO($dsn, $data['username'], $data['password']);

      //Set common attributes
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      return $conn;
    } catch (\PDOException $e) {
      throw $e;
    } catch( \Exception $e) {
      throw $e;
    }
  }
}
