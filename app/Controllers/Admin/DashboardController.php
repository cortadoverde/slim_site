<?php

namespace App\Controllers\Admin;

class DashboardController extends Controller
{

  public function index( $request, $response )
  {
    return $this->view->render($response, 'dashboard/index.twig');
  }

}
