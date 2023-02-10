<?php

namespace Training\Patterns\Decorator;

class ItalicPenDecorator extends AbstractPenDecorator
{
    public function write(string $writing): string
    {
        return sprintf("<i>%s</i>", $this->writer->write($writing));
    }
}
