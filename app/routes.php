<?php

$container = $app->getContainer();

// Url's publicas
$app->group('', function(){
  $this->get('/'                , \App\Controllers\HomeController::class         . ':index');
  $this->get('/quienes_somos'   , \App\Controllers\QuienesSomosController::class . ':index');
  $this->get('/servicios'       , \App\Controllers\ServiciosController::class    . ':index');
  $this->get('/informes'        , \App\Controllers\InformesController::class     . ':index');
  $this->get('/trampas_de_luz'  , \App\Controllers\TrampasDeLuzController::class . ':index');
  $this->get('/links'           , \App\Controllers\LinksController::class        . ':index');
  $this->get('/admin/login'     , \App\Controllers\UsersController::class        . ':login' )->setName( 'login'  );
  $this->get('/admin/logout'    , \App\Controllers\UsersController::class        . ':logout')->setName( 'logout' );
  $this->post('/admin/login'    , \App\Controllers\UsersController::class        . ':process' );

  $this->get('/galeria_de_fotos', \App\Controllers\GaleriasController::class     . ':index');
  $this->get('/galeria_de_fotos/{id}', \App\Controllers\GaleriasController::class     . ':view');

})
  //->add( new \App\Middleware\Account\CheckPermission( $container ) )
  //->add( new \App\Middleware\Account\SetDatabase )
;


$app->group('/admin', function(){
    $this->get('', \App\Controllers\Admin\DashboardController::class . ':index');
    $this->get('/', \App\Controllers\Admin\DashboardController::class . ':index')->setName('admin.home');

    //Upload
    $this->post('/upload', \App\Controllers\Admin\UploadController::class . ':upload');
    $this->delete('/upload', \App\Controllers\Admin\UploadController::class . ':delete');

    //Galerias
      //index
      $this->get('/galerias', \App\Controllers\Admin\GaleriasController::class . ':index')->setName('galerias.index');
      //Add
      $this->get('/galerias/agregar', \App\Controllers\Admin\GaleriasController::class . ':add');
      $this->post('/galerias/agregar', \App\Controllers\Admin\GaleriasController::class . ':save');
      //update
      $this->get('/galerias/editar/{id}', \App\Controllers\Admin\GaleriasController::class . ':edit');
      $this->post('/galerias/editar/{id}', \App\Controllers\Admin\GaleriasController::class . ':update');
      //borrar
      $this->get('/galerias/borrar/{id}', \App\Controllers\Admin\GaleriasController::class . ':delete');

    // Secciones
      //index
      $this->get('/secciones', \App\Controllers\Admin\SectionsController::class . ':index')->setName('sections.index');
      //add
      $this->get('/secciones/agregar', \App\Controllers\Admin\SectionsController::class . ':add')->setName('sections.add');
      $this->post('/secciones/agregar', \App\Controllers\Admin\SectionsController::class . ':save');
      //update
      $this->get('/secciones/editar/{id}', \App\Controllers\Admin\SectionsController::class . ':edit')->setName('sections.edit');
      $this->post('/secciones/editar/{id}', \App\Controllers\Admin\SectionsController::class . ':update');
      //delete
      $this->get('/secciones/borrar/{id}', \App\Controllers\Admin\SectionsController::class . ':delete')->setName('sections.delete');
  })
  ->add( new App\Middleware\Account\CheckPermission( $container ) )
;

// ->add( new \App\Middleware\Account\CheckPermission );
