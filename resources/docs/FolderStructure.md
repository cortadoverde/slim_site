| System | Version | Created by |
| ------ | ------- | ---------- |
| Wehaa Reports | 1.0 | [samu] |

[samu]: mailto:p.a.samu@wehaa.com "Pablo Adrian Samudia"

# Estructura de directorios

La estructura de directorio debe mantenerse lo mas simple y
consistente posible para lograr escalabilidad y
mantenibilidad.

## ./

Directorio Raiz

```
.
├── app
├── public
├── resources
└── vendor
```

---

## ./app


Es la carpeta mapeada por el PSR-4 para el namespace App

```
app
├── Controllers
│   └── Traits
├── Middleware
│   ├── Account
│   └── Report
└── Routes
```

### ./app/Controllers

Contiene la capa logica para procesar los requests

### ./app/Controllers/Traits

Contiene traits para manejo repetitivo de codigo separando
por funcionalidades especificas

### ./app/Middleware

Al ejecutar una aplicacion con Slim Framework los objetos
Request y Response atraviesan la estructura de Middleware
desde afuera hacia adentro. Primero ingresa por el
Middleware mas externo, luego con el siguiente y asi
sucesivamente hasta que finalmente llegan a la Aplicacion
Slim en si.
Despues que la Aplicacion Slim despache la ruta el objeto
Response resultante sale de la Aplicacion Slim y atraviesa
la estructua de Middleware desde adentro hacia afuera

### ./app/Routes

Define los grupos de captura para el router y la asignación
Middlewares

---

# ./public

```
public
└── dist
    ├── components
    └── themes
        ├── basic
        │   └── assets
        │       └── fonts
        ├── default
        │   └── assets
        │       ├── fonts
        │       └── images
        └── wehaa
            └── assets
                └── fonts
```

End point de la aplicacion http, todo el flujo de request
es derivado a ```./public```, por consiguiente se
almacenaran los recursos para servir al cliente
( imagenes, estilos, scripts, etc ).

### ./public/dist/components

Contiene los estilos y los scripts de cada componente del
front end.

### ./public/dist/themes/{$theme_name}/assets

Contiene los recursos especificos para un theme

---

## ./resources

Contiene los archivos de compilación para hacer mas extensible
y escalado el proyecto, para lograr una separación en capas que
permita optimizar la definicion de las particularidades de una
implementacion partiendo de una base organizada

```
resources/
├── build
│   └── src
│       ├── definitions
│       │   ├── behaviors
│       │   ├── collections
│       │   ├── elements
│       │   ├── globals
│       │   ├── modules
│       │   └── views
│       ├── site
│       │   ├── collections
│       │   ├── elements
│       │   ├── globals
│       │   ├── modules
│       │   └── views
│       └── themes
│           ├── default
│           │   ├── assets
│           │   ├── collections
│           │   ├── elements
│           │   ├── globals
│           │   ├── modules
│           │   └── views
│           └── wehaa
│               ├── assets
│               ├── collections
│               ├── elements
│               ├── globals
│               └── modules
├── docs
└── themes
    ├── default
    │   ├── app
    │   │   └── error
    │   └── templates
    │       └── partials
    └── wehaa
        └── views
            ├── Dashboard
            └── templates
                └── partial
```


### ./resources/build

Contiene los componenetes separados por 3 jerarquias

* definitions: Son las reglas de estilos y comportamientos base de
  todos los estilos

* site: Son las reglas de estilos y comportamientos para el sitio en particular
  ej: Particularidades de un cliente que utiliza un mismo theme que otro cliente
  pero se dan unicamente en ese sitio

* theme: Son las reglas generales para una identidad de estilo e imagen.


### ./resources/doc

Contiene la documentación y referencias del desarrollo, como por ejemplo este
documento FolderStructure.md, que en una futura implementacion se podria
utilizar como wiki, ya que el formato markdown utilizado para esta documentacion
es bastante amigable y flexible


### ./resources/themes

Contiene las vistas para el Engine de renderizado Twig, Se aplica la misma
regla de jerarquización en el build para permitir la sobreescritura de
templates y asi mantener integridad en el theme original y las particularidades
de la implementación de un cliente determinado, esto permite por ejemplo tener
reglas heredadas de un theme y personlizarlo sin reescribir todos los templates
sino solamente los que que hagan match en el scope de renderización.
