<?php

use Illuminate\Database\Capsule\Manager as Capsule;

// instate capsule
$capsule = new Capsule;

// set database connection
$capsule->addConnection([
    'driver'    => env('driver'),
    'host'      => env('host'),
    'database'  => env('database'),
    'username'  => env('username'),
    'password'  => env('password'),
    'charset'   => env('charset'),
    'collation' => env('collation'),
    'prefix'    => '',
]);

// set capsule in global access
$capsule->setAsGlobal();

$capsule->bootEloquent();
