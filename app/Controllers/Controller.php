<?php
namespace App\Controllers;

use App\Model\Seccion;

class Controller
{
  use \App\Traits\HasContainer;
  use \App\Controllers\Traits\ThemePage;


  protected $section;
  protected $mainMenu = [
    [
      'name'   => 'Home',
      'active' => true,
      'url'    => '/'
    ],
    [
      'name'   => 'Quienes Somos',
      'active' => false,
      'url'    => '/quienes_somos'
    ],
    [
      'name'   => 'Servicios',
      'active' => false,
      'url'    => '/servicios'
    ],
    [
      'name'   => 'Informes',
      'active' => false,
      'url'    => '/informes'
    ],
    [
      'name'   => 'Galeria de fotos',
      'active' => false,
      'url'    => '/galeria_de_fotos'
    ],
    [
      'name'   => 'Trampas de luz',
      'active' => false,
      'url'    => '/trampas_de_luz'
    ],
    [
      'name'   => 'Links',
      'active' => false,
      'url'    => '/links'
    ],
  ];

  public function init()
  {
    $this->setTheme('monitereocultivo');

    $this->setBrandName('SMC - Monitoreo de cultivo ');

    $this->setPageTitle('SMC');

    $this->setMenuActive( $this->section );

    $this->loadTheme();
  }

  public function index( $request, $response )
  {
    $data = Seccion::where('name', $this->section)->first();

    return $this->view->render($response, 'sections/page.twig', ['section' => $data]);
  }

  protected function setMenuActive( $name )
  {
    foreach( $this->mainMenu AS $index => $menu )
    {
      $this->mainMenu[$index]['active'] = false;
    }

    $key = array_search($name, array_column($this->mainMenu, 'name'));

    $this->mainMenu[$key]['active'] = true;

    // Redefinir el menu para que tome el cambio
    $this->addGlobal( 'mainMenu', $this->mainMenu);

  }
}
