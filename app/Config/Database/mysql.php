<?php

$container = $app->getContainer();

$container['settings']['mysql'] = [
  'driver'  => 'mysql',
  'host'    => 'localhost',
  'database'=> 'monitoreocultivo',
  'username' => 'root',
  'password' => 'sunga'
];
