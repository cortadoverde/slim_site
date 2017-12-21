<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$container = $app->getContainer();

$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['mysql']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['db'] = function ($c) {
    return $capsule;
};
