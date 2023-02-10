<?php

namespace Training\Patterns\Decorator;

interface WriterInterface
{
    public function write(string $writing): string;
}
