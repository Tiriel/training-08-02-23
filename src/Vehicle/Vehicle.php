<?php

namespace Vehicle;

use Member\AuthInterface;
use Utils\StringableTrait;

abstract class Vehicle implements StartableInterface
{
    use StringableTrait;

    public function __construct(
        string $name,
        protected readonly string $brand,
        protected readonly string $model,
        protected readonly AuthInterface $user
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
