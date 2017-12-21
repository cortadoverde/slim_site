<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

! defined('DS')      ? define( 'DS', DIRECTORY_SEPARATOR ) : null ;
! defined('ROOT')    ? define( 'ROOT', dirname( __DIR__ ) ) : null ;
! defined('APP_DIR') ? define( 'APP_DIR', ROOT . DS . 'app' ) : null ;

require __DIR__ . '/../bootstrap/app.php';

$app->run();
