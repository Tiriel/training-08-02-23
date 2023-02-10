<?php

namespace Training\Patterns\Decorator;

class BoldPenDecorator extends AbstractPenDecorator
{
    public function write(string $writing): string
    {
        return sprintf("<b>%s</b>", $this->writer->write($writing));
    }
}
