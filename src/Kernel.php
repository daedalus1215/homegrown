<?php
/**
 * Created by PhpStorm.
 * User: ladam
 * Date: 1/24/2019
 * Time: 6:53 AM
 */

namespace App;


use App\Container\Container;
use App\Controller\IndexController;
use App\Service\Serializer;
use App\Formatter\JSON;


class Kernel
{
    private $container;

    public function __construct()
    {
        $this->container = new Container();
    }

    public function getContainer(): Container
    {
        return $this->container;
    }

    public function boot()
    {
        $this->bootContainer($this->container);
    }

    private function bootContainer(Container $container)
    {
        $this->container->addService(\App\Formatter\FormatterInterface::class, function() use ($container) {
            return new JSON();
        });

        $container->addService(IndexController::class, function () use ($container) {
            return new IndexController($container->getService(Serializer::class));
        });

        $container->addService(Serializer::class, function () use ($container) {
            return new Serializer($container->getService('format'));
        });
    }
}