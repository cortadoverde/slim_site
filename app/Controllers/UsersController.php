<?php

namespace App\Controllers;

use App\Components\SessionComponent;

class UsersController extends Controller
{

  public function init()
  {
    $this->setTheme('admin');

    $this->setBrandName('SMC - Monitoreo de cultivo ');

    $this->setPageTitle('Admin');

    $this->loadTheme();
  }

  public function login( $request, $response )
  {

    return $this->view->render($response, 'login.twig');
  }

  public function process( $request, $response )
  {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = \App\Components\UserComponent::getInstance();
    $user->login($username, $password);

    if( $user->isLogin() ) {
      if( SessionComponent::exists('uri') ) {
        $uri = SessionComponent::get('uri');
        SessionComponent::unset('uri');
        return $response->withRedirect($uri);
      }
      return $response->withRedirect($this->container->get('router')->pathFor('admin.home'));
    } else {
      $this->logout( $request, $response );
    }
  }

  public function logout( $request, $response )
  {
    $loginUrl = $this->container->get('router')->pathFor('login');

    SessionComponent::destroy();

    return $response->withRedirect($loginUrl);
    //return $this->view->render($response, 'home.twig');
  }


}
