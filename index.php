<?php

use App\Container\Container;
use App\Formatter\SimpleFormatter;
use App\Controller\IndexController;
use App\Service\Serializer;
use App\Formatter\JSON;

require __DIR__ . '/vendor/autoload.php';



$container = new Container();


$container->addService(\App\Formatter\FormatterInterface::class, function() use ($container) {
    return new JSON();
});


$container->addService(IndexController::class, function () use ($container) {
    return new IndexController($container->getService(Serializer::class));
});

 $container->addService(Serializer::class, function () use ($container) {
     return new Serializer($container->getService('format'));
 });

// $container->loadServices("App\\Formatter");
$container->loadServices("App\\Service");
$container->loadServices("App\\Controller");
var_dump($container->getServices());
var_dump($container->getService(IndexController::class));
var_dump($container->getService(\App\Controller\PostController::class));



// /**
//  * @var IndexController $indexController
//  */
// $indexController = $container->getService(IndexController::class);

// echo $indexController->dispatch();