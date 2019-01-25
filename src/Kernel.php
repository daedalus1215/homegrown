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
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use App\Annotations\Route;


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

    /**
     * @param Container $container
     * @throws \Doctrine\Common\Annotations\AnnotationException
     */
    private function bootContainer(Container $container)
    {
        $this->container->addService(\App\Formatter\FormatterInterface::class, function () use ($container) {
            return new JSON();
        });

        $container->addService(IndexController::class, function () use ($container) {
            return new IndexController($container->getService(Serializer::class));
        });

        $container->addService('format', function () use ($container) {
            return new JSON();
        });

        $container->addService(Serializer::class, function () use ($container) {
            return new Serializer($container->getService('format'));
        });

        AnnotationRegistry::registerLoader('class_exists');
        $reader = new AnnotationReader();

        $routes = [];

        // Parse the route in the Annotation of the controller
        $container->loadServices('App\\Controller', function (string $serviceName, \ReflectionClass $class) use ($reader, &$routes) {
            $route = $reader->getClassAnnotation($class, Route::class);
            if (!$route) {
                return;
            }

            // parsed Route
            $baseRoute = $route->route;


            // Parse the route in the Annotation of the Controller's Methods
            foreach ($class->getMethods() as $method) {
                $route = $reader->getMethodAnnotation($method, Route::class);

                if (!$route) {
                    continue;
                }

                $routes[str_replace('//', '/', $baseRoute . $route->route)] = [
                    'service' => $serviceName,
                    'method' => $method->getName()
                ];
            }
        }
        );
    }

    public function handleRequest()
    {
        $uri = $_SERVER['REQUEST_URI'];
        //@todo: left off here.
    }
}