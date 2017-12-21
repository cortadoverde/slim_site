<?php

/**
 * Funcion para simular el uso de collecciones en la libreria
 * Jenssegers/Mongodb
 */
function app()
{
    return new class {
        public function version()
        {
            return '5.4';
        }
    };
}
