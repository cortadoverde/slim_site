<?php
session_start();

$autoload = require_once __DIR__ . '/../vendor/autoload.php';

$app =
  App\Runner::init(
    new \Slim\App([
      'settings' => [
        'displayErrorsDetails' => true
      ]
    ])
  );

App\Loader::setApp( $app );

$container = $app->getContainer();


App\Loader::setPaths([
  'Config' => [
    'core' => [
      'dir' => 'Config/Database'
    ]
  ],
  'Dependencies' => [
    'core' => 'Dependencies/Core'
  ],
  'Routes' => [
    'core' => 'Routes/core',
    'app'  => 'Routes/app',
    'api'  => 'Routes/api'
  ],
]);

App\Loader::load();

$container['view'] = function( $container ) {

  $view = new \Slim\Views\Twig( __DIR__ . '/../resources/themes/default' , [
    'cache' => false
  ]);

  $view->addExtension( new \Slim\Views\TwigExtension(
    $container->router,
    $container->request->getUri()
  ));

  return $view;
};

// App Register controllers

$container['DashboardController'] = function( $container ){
  return new \App\Controllers\DashboardController( $container );
};

$container['HomeController'] = function( $container ){
  return new \App\Controllers\HomeController( $container );
};

$container['AccountController'] = function( $container ){
  return new \App\Controllers\AccountController( $container );
};

require_once __DIR__ . '/../app/routes.php';
