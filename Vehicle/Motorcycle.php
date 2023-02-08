<?php

namespace Vehicle;

class Motorcycle extends Vehicle
{
    protected function doStart(): bool
    {
        return false;
    }
}
