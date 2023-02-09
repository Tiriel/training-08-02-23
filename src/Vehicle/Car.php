<?php

declare(strict_types = 1);

namespace Vehicle;

class Car extends Vehicle implements YearInterface
{
    private int $year;

    public function setYear(int $year): void // signature
    {
        $this->year = $year;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    protected function doStart(): bool
    {
        return true;
    }
}

//$car = new Car('Super R5', 'Renault', 'R5');
//$newCar = new Car('Citroën', 'C5');
//unset($newCar);
//$car->brand = 'Mercedes';
//$car->doors = 5;
//$car->setYear(2011);
