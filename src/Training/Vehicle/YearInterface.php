<?php

namespace Training\Vehicle;

interface YearInterface
{
    public function setYear(int $year): void;

    public function getYear(): int;
}
