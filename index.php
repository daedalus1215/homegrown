<?php

use App\Container\Container;
use App\Formatter\SimpleFormatter;
use App\Controller\IndexController;
use App\Service\Serializer;
use App\Formatter\JSON;

require __DIR__ . '/vendor/autoload.php';



$container = new Container();


// $container->addService(IndexController::class, function () use ($container) {
//     return new IndexController($container->getService(Serializer::class));
// });


$container->loadServices("App\\Formatter");
$container->loadServices("App\\Service");




/**
 * @var IndexController $indexController
 */
$indexController = $container->getService(IndexController::class);

echo $indexController->dispatch();