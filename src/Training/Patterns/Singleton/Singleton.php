<?php

namespace Training\Patterns\Singleton;

class Singleton
{
    private static Singleton $object;

    private function __construct() {}

    private function __clone(): void {}

    public static function getObject(): static
    {
        return static::$object ?? static::$object = new static();
    }
}
