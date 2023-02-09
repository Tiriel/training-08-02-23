<?php

namespace Vehicle;

abstract class Vehicle implements StartableInterface
{
    use \Utils\StringableTrait;

    public function __construct(
        string $name,
        protected readonly string $brand,
        protected readonly string $model
    ) {
        $this->name = $name;
    }

    public function start(): bool
    {
        if (!$this->brand || !$this->model) {
            return false;
        }

        return $this->doStart();
    }

    abstract protected function doStart(): bool;
}
