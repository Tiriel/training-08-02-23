<?php

namespace Services\Routing;

class Route
{
    private readonly string $controller;
    private readonly string $action;

    public function __construct(
        private readonly string $name,
        private readonly string $path,
        private readonly ?array $requirements = null,
        private readonly ?array $defaults = null,
        private readonly array $methods = ['GET']
    ) {
        [$this->controller, $this->action] = explode('_', $this->name, 2);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getController(): string
    {
        return $this->controller;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function getRequirements(): ?array
    {
        return $this->requirements;
    }

    public function getDefaults(): ?array
    {
        return $this->defaults;
    }

    public function getMethods(): array
    {
        return $this->methods;
    }
}
