<?php

namespace Training\Patterns\Decorator;

class TitlePenDecorator extends AbstractPenDecorator
{

    public function write(string $writing): string
    {
        return sprintf("<h1>%s</h1>", $this->writer->write($writing));
    }
}
