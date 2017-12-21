<?php

namespace App\Traits;

trait HasContainer
{
  protected $container;

  public function __construct( $container )
  {
    $this->container = $container;
    $this->init();
  }

  protected function init()
  {
    
  }

  public function __get( $property )
  {
    if( $this->container->{$property} ){
      return $this->container->{$property};
    }
  }
}
