# Instalación

clonar el repositorio y hacer un dumpautoload para apuntar el autoload a la libreria correspondiente

```
  git clone git@github.com:cortadoverde/slim_site.git

  cd slim_site

  composer install
```

* Desarrollado completamente orientado a objetos, siguiendo los estandares de diseño PSR-4

* Para esta version se utilizo el micro framework slim 3 ( https://www.slimframework.com )
  * Manejo de rutas y middlewares
  * Dependency Container ( permite mantener un contedor unico en tiempo de ejecución

* Para el manejo de abstraccion de datos implemente Eloquent ( https://laravel.com/docs/5.5/eloquent )
ORM
  * Mappeo y relaciones de modelos
  * Abstraccion de datos poderosa

* Para el manejo de plantillas utilizo el gestor de templates Twig (https://twig.symfony.com/doc/2.x/)
  * Gran gestor de abstraccion visual, permite extender bloques y manter una organizacion bien compacta y escalable

A toda esta base desarrollo un conjunto de clases que permiten interactuar con todas estas tecnologias y darle sentido a la aplicacion :P

## Estructura de directorio:

    .
    ├── app
    ├── bootstrap
    ├── composer.json
    ├── public
    ├── resources
    └── vendor


### composer.json

    {
        "require": {
            "slim/slim": "^3.7",
            "slim/twig-view": "^2.2",
            "illuminate/database": "^5.4",+
        },

        "autoload" : {
          "psr-4" : {
            "App\\" : "app"
          }
        }
    }


### app

La carperta app contiene la estructura principal

    app
    ├── Components
    ├── Config
    ├── Config.php
    ├── Controllers
    ├── Dependencies
    ├── Loader.php
    ├── Middleware
    ├── Model
    ├── Models
    ├── Routes
    ├── routes.php
    ├── Runner.php
    └── Traits

### app/Components

Aqui se guardan los componentes para reutilizar que no integran la estructura MVC directamente, pasan a ser helpers para mantener un codigo mas limpio y ordenado

    app/Components/
    ├── DbComponent.php
    ├── SessionComponent.php
    ├── UploadComponent.php
    └── UserComponent.php


### app/Config

Directorio de configuracion, el mismo es cargado con la instruccion App\Loader::load() luego que en el bootstrap se definan los directorios a recorrer

    app/Config/
    └── Database
        ├── mongo.php
        └── mysql.php

### app/Controllers

Contiene los archivos que se encargan de recibir la peticion y acceder a los modelos para comunicar luego a la vista

    app/Controllers/
    ├── AccountController.php
    ├── Admin
    │   ├── Controller.php
    │   ├── DashboardController.php
    │   ├── GaleriasController.php
    │   ├── SectionsController.php
    │   └── UploadController.php
    ├── Controller.php
    ├── DashboardController.php
    ├── GaleriasController.php
    ├── HomeController.php
    ├── InformesController.php
    ├── LinksController.php
    ├── QuienesSomosController.php
    ├── ServiciosController.php
    ├── Traits
    │   └── ThemePage.php
    ├── TrampasDeLuzController.php
    └── UsersController.php

### app/Dependencies

Contiene archivos extras para funcionalidades adicionales, por ejemplo para poder usar eloquent hubo que hacer una funcion que simule la version de laravel

    app/Dependencies/
    └── Core
        ├── connections.php
        ├── functions.php
        └── simulate_laravel_app.php


### app/Middleware

Contiene los intermediarios entre el dispatch y el controlador, se conoce como estructura de cebolla, al invocarse una ruta pasa por una capa previa llamada middleware, desde aquie se puede hacer controlers antes de ejecutar un request o despues de haberlo ejecutado.

    app/Middleware/
    ├── Account
    │   └── CheckPermission.php
    └── BaseMiddleware.php

### app/Model

Contiene los modelos que extienden de Eloquent y definen los tipos de relacion

    app/Model/
    ├── Galeria.php
    ├── Image.php
    └── Seccion.php

### app/Traits

Contiene traits para mantener organizado mejor las extenciones de clases ( http://php.net/manual/es/language.oop5.traits.php )

    app/Traits/
    └── HasContainer.php
