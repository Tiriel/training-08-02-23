<?php

namespace App;

use Config\Services;
use Services\Controller\BaseController;

class Container
{
    protected array $services = [];
    public function get(string $className, bool $argsOnly = false): mixed
    {
        $arguments = Services::get($className);

        foreach ($arguments as $key => $service) {
            if (is_string($service) && \class_exists($service)) {
                $arguments[$key] = $this->get($service);
            }
        }

        if ($argsOnly) {
            return $arguments;
        }

        return $this->services[$className] ?? $this->services[$className] = new $className(...$arguments);
    }

    public function getController(string $controller): BaseController
    {
        $controller = 'Services\\Controller\\' . ucfirst($controller) . 'Controller';

        if (array_key_exists($controller, $this->services)) {
            return $this->services[$controller];
        }

        $arguments = $this->get(BaseController::class, true);

        return new $controller(...$arguments);
    }
}
