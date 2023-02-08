<?php

namespace Utils;

trait StringableTrait
{
    protected string $name;

    public function __toString(): string
    {
        return $this->name;
    }
}
