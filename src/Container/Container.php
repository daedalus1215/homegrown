<?php

namespace App\Container;

class Container {
    private $services = [];
    private $aliases = [];

    public function addService(string $name, \Closure $closure, ?string $alias = null): void
    {
        $this->services[$name] = $closure;

        if ($alias) {
            $this->addAlias($alias, $name);
        }
    }

    public function addAlias(string $alias, string $service): void 
    {
        $this->aliases[$alias] = $name;
    }

    public function hasAlias(string $name):bool 
    {
        return isset($this->aliases[$name]);
    }

    public function getService(string $name)
    {
        if (!$this->hasService($name)) {
            return new ContainerException("No identifier for service with the name of: ".$name);
        }

        if ($this->services[$name] instanceof \Closure) {
            $this->services[$name] = $this->services[$name]();
        }

        return $this->services[$name];
    }

    public function hasService(string $name): bool 
    {
        return isset($this->services[$name]);
    }


    public function getServices():array
    {
        return [
            'services' => array_keys($this->services)
        ];
    }
}


