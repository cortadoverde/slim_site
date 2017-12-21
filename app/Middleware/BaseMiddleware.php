<?php

namespace App\Middleware;

use App\Middleware\BaseMiddleware;

Class BaseMiddleware
{

  use \App\Traits\HasContainer;

  public function __invoke( $request, $response, $next )
  {
      return $next( $request, $response );
  }

}
