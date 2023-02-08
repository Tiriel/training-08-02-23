<?php

declare(strict_types = 1);

class Car
{
    public readonly string $brand;
    public readonly string $model;
    private int $year;

    public function __construct(string $brand, string $model)
    {
        $this->brand = $brand;
        $this->model = $model;
    }

    public function setYear(int $year): void // signature
    {
        $this->year = $year;
    }

    public function start(Member $member): void
    {
        $bool = $member->auth('', 'bar');
    }
}

$car = new Car('Renault', 'R5');
//$newCar = new Car('Citroën', 'C5');
//unset($newCar);
//$car->brand = 'Mercedes';
//$car->doors = 5;
//$car->setYear(2011);
