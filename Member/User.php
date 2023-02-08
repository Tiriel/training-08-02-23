<?php

namespace Member;

use \Utils\StringableTrait;

abstract class User
{
    use StringableTrait;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(mixed $name): void
    {
        $this->name = $name;
    }
}
