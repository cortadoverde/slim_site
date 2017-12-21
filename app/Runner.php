<?php

namespace App;

/**
 * El objetivo de este objeto
 * es devolver la instncia del hilo de proceso actual
 * para poder acceder a sus metodos
 */
class Runner
{

  public static $app;

  public static function init( $instance )
  {
    if( self::$app == null ){
      self::$app = $instance;
      self::loadEnviroment();
    }

    return self::$app;
  }

  private static function loadEnviroment()
  {
    Config::load();
  }

}
