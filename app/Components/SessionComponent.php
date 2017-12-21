<?php

namespace App\Components;

Class SessionComponent
{

  private static function is_session_started()
  {
    if ( php_sapi_name() !== 'cli' ) {
       if ( version_compare(phpversion(), '5.4.0', '>=') ) {
           return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
       } else {
           return session_id() === '' ? FALSE : TRUE;
       }
   }
   return FALSE;
  }

  private static function session_start()
  {
    if ( self::is_session_started() === FALSE ) session_start();
  }

  public static function get( $index, $default = false )
  {
    self::session_start();
    if( isset( $_SESSION[$index] ) ) {
      return $_SESSION[$index];
    }
    return $default;
  }

  public static function exists( $index )
  {
    self::session_start();
    return isset( $_SESSION[$index] );
  }

  public static function set( $index, $value )
  {
    self::session_start();
    $_SESSION[$index] = $value;
  }

  public static function unset( $index )
  {
    self::session_start();
    unset($_SESSION[$index]);
    return;
  }

  public static function destroy()
  {
    self::session_start();
    session_destroy();
  }

}
