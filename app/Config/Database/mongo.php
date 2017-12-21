<?php

$container = $app->getContainer();

$container['settings']['mongodb'] = [
  'driver'  => 'mongodb',
  'host'    => 'localhost',
  'port'    => 27017,
  'database'=> 'view_1',
  'username' => 'wehaa',
  'password' => 'maoiUASDuibfa08hfa',
  'options' => [
    'database' => 'admin'
  ]
];
