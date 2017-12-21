<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller AS BaseController;

class Controller extends BaseController
{

  public function init()
  {
    parent::init();
    $this->setTheme('admin');
    $this->loadTheme();
  }

}
