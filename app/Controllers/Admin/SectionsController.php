<?php

namespace App\Controllers\Admin;

use App\Model\Seccion AS Model;

class SectionsController extends Controller
{

  public function index( $request, $response )
  {
    $rows = Model::all();
    return $this->view->render($response, 'sections/index.twig', ['data' => $rows]);

  }

  public function add( $request, $response )
  {
    $this->addGlobal('action', 'agregar');
    return $this->view->render($response, 'sections/add.twig');
  }

  public function edit( $request, $response )
  {
    $resource_id = $request->getAttribute('id');
    $this->addGlobal('action', 'editar/' . $resource_id);
    $model = Model::find($resource_id);
    $images = $model->images()->first();

    return $this->view->render($response, 'sections/add.twig', ['model' => $model, 'images' => [$images]] );
  }

  public function save( $request, $response )
  {

    $data    = $_POST['data'];

    $model = new Model;
    $model->title    = $data['title'];
    $model->content  = $data['content'];
    $model->keywords = $data['keywords'];
    $model->metadescription = $data['metadescription'];
    $model->og_titel = $data['title'];
    $model->image_id = $data['image'][0];
    $model->save();

    $mode->images()->save($data['image'][0]);
    // Redireccionar a galerias
    return $response->withRedirect($this->container->get('router')->pathFor('sections.index'));

  }

  public function update( $request, $response )
  {
    $data = $_POST['data'];

    $resource_id = $request->getAttribute('id');
    $model = Model::find($resource_id );

    $model->title            = $data['title'];
    $model->content          = $data['content'];
    $model->keywords         = $data['keywords'];
    $model->metadescription  = $data['metadescription'];
    $model->og_title         = $data['title'];
    $model->image_id         = $data['image'][0];
    $model->save();

    // Redireccionar a galerias
    return $response->withRedirect($this->container->get('router')->pathFor('sections.index'));

  }

  public function delete( $request, $response )
  {
    $resource_id = $request->getAttribute('id');
    $model = Model::find($resource_id );
    $model->delete();

    // Redireccionar a galerias
    return $response->withRedirect($this->container->get('router')->pathFor('sections.index'));

  }
}
