<?php

// Database information
$settings = array(
    'driver' => 'mysql',
    'host' => 'localhost',
    'database' => 'lumen',
    'username' => 'root',
    'password' => '',
    'collation' => 'utf8_general_ci',
    'charset' => 'utf8'
);

$capsule = new \Illuminate\Database\Capsule\Manager();
$capsule->addConnection($settings, 'master');
$manager = $capsule->getDatabaseManager();
$manager->setDefaultConnection('master');

$capsule->setAsGlobal();
$capsule->bootEloquent();
