<?php
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
$capsule = new Capsule;
$capsule->addConnection([
    'driver'         => 'mysql',
    'host'           => DB_HOST,
    'database'    => DB_NAME,
    'username'  => DB_USER,
    'password'   => DB_PASSWORD,
    'charset'       => DB_CHARSET,
   //'collation'    => 'utf8_unicode_ci',
    'prefix'        => '',
]);
$capsule->setEventDispatcher(new Dispatcher(new Container));
$capsule->setAsGlobal();
$capsule->bootEloquent();
return $capsule;