<?php

abstract class Vehicle implements StartableInterface
{
    public function __construct(
        protected readonly string $brand,
        protected readonly string $model
    ) {}
    
    public function start(): bool
    {
        if (!$this->brand || !$this->model) {
            return false;
        }

        return $this->doStart();
    }

    abstract protected function doStart(): bool;
}
