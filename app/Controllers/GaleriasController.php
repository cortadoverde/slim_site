<?php

namespace App\Controllers;

use App\Model\Galeria;
use App\Model\Seccion;
class GaleriasController extends Controller
{

  protected $section = 'Galeria de fotos';


  public function index( $request , $response )
  {

    $rows    = Galeria::with(['images' => function( $query ) {
      $query->orderBy('galeria_images.sort');
    }])->get();
    $section = Seccion::where('name', $this->section)->first();

    return $this->view->render($response, 'sections/galerias/index.twig', ['data' => $rows, 'section' => $section]);

  }

  public function view( $request, $response )
  {
    $resource_id = $request->getAttribute('id');
    $rows        = Galeria::where('id', $resource_id)->with(['images' => function( $query ) {
      $query->orderBy('galeria_images.sort');
    }])->first();
    return $this->view->render($response, 'sections/galerias/view.twig', [ 'data' => $rows ]);
  }

}
