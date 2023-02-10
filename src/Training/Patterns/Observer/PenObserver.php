<?php

namespace Training\Patterns\Observer;

use Training\Patterns\Decorator\WriterInterface;
use Training\Patterns\Factory\PenFactory;

class PenObserver implements ObserverInterface
{
    private WriterInterface $writer;

    public function __construct()
    {
        $this->writer = PenFactory::create('bold');
    }

    public function getNotified(mixed &$data): void
    {
        $data = $this->writer->write($data);
    }
}
