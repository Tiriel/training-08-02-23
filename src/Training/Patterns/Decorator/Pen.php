<?php

namespace Training\Patterns\Decorator;

class Pen implements WriterInterface
{
    public function write(string $writing): string
    {
        return $writing;
    }
}
