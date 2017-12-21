<?php

namespace App\Controllers\Admin;

use App\Model\Galeria;

class GaleriasController extends Controller
{

  public function index( $request, $response )
  {
    $rows = Galeria::all();
    return $this->view->render($response, 'galerias/index.twig', ['data' => $rows]);

  }

  public function add( $request, $response )
  {
    $this->addGlobal('action', 'agregar');
    return $this->view->render($response, 'galerias/add.twig');
  }

  public function edit( $request, $response )
  {
    $galeria_id = $request->getAttribute('id');
    $this->addGlobal('action', 'editar/' . $galeria_id);
    $galeria = Galeria::find($galeria_id);
    $images = $galeria->images()->orderBy('sort')->get();

    return $this->view->render($response, 'galerias/add.twig', ['galeria' => $galeria, 'images' => $images] );
  }

  public function save( $request, $response )
  {

    $data    = $_POST['data'];

    $galeria = new Galeria;
    $galeria->title = $data['title'];
    $galeria->description = $data['description'];

    $galeria->save();

    // Asociar las imagenes
    $imagesSort = [];
    foreach($data['image'] AS $order => $id ) {
      $imagesSort[] = ['image_id' => $id, 'sort' => $order ];
    }

    $galeria->images()->attach($imagesSort);

    // Redireccionar a galerias
    return $response->withRedirect($this->container->get('router')->pathFor('galerias.index'));

  }

  public function update( $request, $response )
  {
    $data = $_POST['data'];
    $galeria_id = $request->getAttribute('id');
    $galeria = Galeria::find($galeria_id );

    $galeria->title = $data['title'];
    $galeria->description = $data['description'];

    $galeria->save();

    $galeria->images()->detach();

    // Asociar las imagenes
    $imagesSort = [];
    foreach($data['image'] AS $order => $id ) {
      $imagesSort[] = ['image_id' => $id, 'sort' => $order ];
    }

    $galeria->images()->attach($imagesSort);

    // Redireccionar a galerias
    return $response->withRedirect($this->container->get('router')->pathFor('galerias.index'));

  }

  public function delete( $request, $response )
  {
    $galeria_id = $request->getAttribute('id');
    $galeria = Galeria::find($galeria_id );
    $galeria->images()->detach();

    $galeria->delete();

    // Redireccionar a galerias
    return $response->withRedirect($this->container->get('router')->pathFor('galerias.index'));

  }
}
