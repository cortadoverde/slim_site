<?php

namespace App\Components;

use \App\Components\SessionComponent AS Session;

class UserComponent
{

  private static $adicHash = 'UIJSfnjnksf!4dk';

  private static $instance = null;

  public $id;
  public $username;
  public $level;
  public $email;

  public static function getInstance()
  {
    if( self::$instance === null ) {
      $user = new self;
      // Checkear si esta definida la session
      if( Session::exists('user') ) {
        $data = Session::get('user');
        $user->mergeData( $data );
      }
      self::$instance = $user;
    }
    return self::$instance;
  }


  private function mergeData( $data )
  {
    foreach ($data as $index => $value) {
      $this->{$index} = $value;
    }
  }

  public function setAdmin( $username , $password )
  {
    return true;  // Desabilitar el setAdmin luego de usarlo
    // Hash compuesto por username, password y un string para tener
    // mayor control en caso de que puedan acceder a lectura de
    $realpassword = md5( $username . $password . self::$adicHash );

    $conn = DbComponent::getInstance()->getDb();

    $stm = $conn->prepare(' UPDATE user SET username = :username, password = :password WHERE id = 1 ');
    $stm->bindParam(':username', $username );
    $stm->bindParam(':password', $realpassword);
    $stm->execute();
  }

  public function login( $username, $password )
  {
    if( $this->id !== null ) {
      return true;
    }
    // Hash compuesto por username, password y un string para tener
    // mayor control en caso de que puedan acceder a lectura de
    $realpassword = md5( $username . $password . self::$adicHash );

    $conn = DbComponent::getInstance()->getDb();

    $stm = $conn->prepare(' SELECT count(*) AS n FROM user WHERE username = :username AND password = :password');
    $stm->bindParam(':username', $username );
    $stm->bindParam(':password', $realpassword);
    $stm->execute();
    $data = $stm->fetch(\PDO::FETCH_ASSOC);
    if( $data['n'] == 1 ) {

      $stm = $conn->prepare(' SELECT id, username, email, status, level FROM user WHERE username = :username AND password = :password');
      $stm->bindParam(':username', $username );
      $stm->bindParam(':password', $realpassword);
      $stm->execute();
      $data = $stm->fetch(\PDO::FETCH_ASSOC);

      Session::set('user', $data );
      $this->mergeData( $data );
      return true;
    }
    return false;
  }

  public function isLogin()
  {
    return $this->id !== null;
  }
}
