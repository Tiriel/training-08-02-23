<?php

namespace Training\Patterns\Decorator;

abstract class AbstractPenDecorator implements WriterInterface
{
    public function __construct(
        protected readonly WriterInterface $writer
    ) {}

    abstract public function write(string $writing): string;
}
