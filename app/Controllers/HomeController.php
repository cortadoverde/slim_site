<?php

namespace App\Controllers;

use App\Models\Track;

class HomeController extends Controller
{

  protected $section = 'Home';
  
  public function index( $request, $response )
  {

    $this->setMenuActive('Galeria de Fotos');
    //debug($this->view->getLoader());

    return $this->view->render($response, 'home.twig');
  }


}
