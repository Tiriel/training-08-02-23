<?php

namespace App;

use Config\Services;

class Container
{
    protected array $services = [];
    public function get(string $className): mixed
    {
        $arguments = Services::get($className);

        foreach ($arguments as $key => $service) {
            if (\class_exists($service)) {
                $arguments[$key] = $this->get($service);
            }
        }

        return $this->services[$className] ?? $this->services[$className] = new $className(...$arguments);
    }
}
