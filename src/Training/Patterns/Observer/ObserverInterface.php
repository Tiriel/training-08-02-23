<?php

namespace Training\Patterns\Observer;

interface ObserverInterface
{
    public function getNotified(mixed &$data): void;
}
