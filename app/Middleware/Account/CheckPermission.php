<?php

namespace App\Middleware\Account;

use App\Middleware\BaseMiddleware;

use App\Components\UserComponent;
use App\Components\SessionComponent AS Session;

Class CheckPermission extends BaseMiddleware
{
  protected $router;

  public function __construct( $container )
  {
    parent::__construct( $container );
    $this->router = $container->get('router');
  }

  public function __invoke( $request, $response, $next )
  {
      $user = UserComponent::getInstance();

      $uri = $request->getUri()->__toString();
      if( ! $user->isLogin() ) {
        Session::set('uri', $uri);
        return $response->withRedirect($this->router->pathFor('login'));
      }

      return $next($request, $response);
  }

}
