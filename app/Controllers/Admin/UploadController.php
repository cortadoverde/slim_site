<?php

namespace App\Controllers\Admin;

use App\Components\UploadComponent AS UploadComponent;

class UploadController extends Controller
{

  public function upload( $request, $response )
  {
    $allPostPutVars = $request->getParsedBody();

    $options = array(
            'upload_dir'         => ROOT . DS . 'public'. DS . 'img' . DS . 'upload' . DS,
            'upload_url'         => $request->getUri()->getBasePath() . '/img/upload/',
            'script_url'         => $request->getUri()->getBasePath() . '/admin/upload',
			      'accept_file_types'  => '/\.(gif|jpe?g|png)$/i',
            'print_response'     => false
    );

    $result = new UploadComponent($options);

    foreach( $result->response['files'] AS $n => $file )
    {
      $store = new \App\Model\Image();
      $store->name = $file->name;
      $store->path = $file->url;
      $store->save();

      $result->response['files'][$n]->id = $store->id;
    }

    header('Content-type: application/json');
    echo json_encode($result->response);die;
  }

  public function delete( $request, $response )
  {
    $allPostPutVars = $request->getParsedBody();
    $fileName = $request->getQueryParam('file');
    $row = \App\Model\Image::where('name', $fileName)->first();
    $row->delete();

    $options = array(
            'upload_dir' => ROOT . DS . 'public'. DS . 'img' . DS . 'upload' . DS,
            'upload_url' => $request->getUri()->getBasePath() . '/img/upload/',
            'script_url' => $request->getUri()->getBasePath() . '/admin/upload',
			      'accept_file_types' => '/\.(gif|jpe?g|png)$/i',
    );

    $result = new UploadComponent($options);

  }



}
