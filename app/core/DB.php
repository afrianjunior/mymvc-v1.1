<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

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

$capsule->setAsGlobal();

$capsule->bootEloquent();