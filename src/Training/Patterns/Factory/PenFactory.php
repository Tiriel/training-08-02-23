<?php

namespace Training\Patterns\Factory;

use Training\Patterns\Decorator\{ItalicPenDecorator};
use Training\Patterns\Decorator\BoldPenDecorator;
use Training\Patterns\Decorator\Pen;
use Training\Patterns\Decorator\TitlePenDecorator;
use Training\Patterns\Decorator\WriterInterface;

class PenFactory
{
    public static function create(string|array $types): WriterInterface
    {
        $types = is_string($types) ? [$types] : $types;

        $writer = new Pen();

        foreach ($types as $type) {
            $type = PenTypes::tryFrom($type);

            $writer = match ($type->value) {
                'bold' => new BoldPenDecorator($writer),
                'italic' => new ItalicPenDecorator($writer),
                'title' => new TitlePenDecorator($writer)
            };
        }

        return $writer;
    }
}
