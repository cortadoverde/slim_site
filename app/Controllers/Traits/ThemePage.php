<?php
namespace App\Controllers\Traits;

trait ThemePage
{

    protected $themePath = \App\Config::PATH_RESOURCES . '/themes/';

    protected $theme = 'default';

    protected $pageTitle;

    protected $brandName;

    public function loadTheme()
    {
      try {
        $this->view->getLoader()->prependPath( $this->themePath . $this->theme);
      } catch (\Exception $e) {
        debug($e);
      }

      $this->addGlobal( 'theme' , $this->theme );
    }

    protected function addGlobal( string $name, $var )
    {
      $this->view->getEnvironment()->addGlobal( $name, $var );
    }

    public function setTheme( string $themeName )
    {
      $this->theme = $themeName;
    }

    public function setThemePath( string $path )
    {
      $this->themePath = $path;
    }

    public function setPageTitle( string $pageTitle )
    {
      $this->pageTitle = $pageTitle;
      $this->addGlobal( 'pageTitle' , $this->pageTitle );
    }

    public function setBrandName( string $brandName )
    {
      $this->brandName = $brandName;
      $this->addGlobal( 'brandName' , $this->brandName );
    }

}
