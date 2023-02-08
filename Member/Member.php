<?php

namespace Member;

use Vehicle\StartableInterface;
use Vehicle\{Car,Motorcycle};

class Member extends User implements AuthInterface
{
    protected static int $count = 0;

    protected array $vehicles = [];

    public function __construct(
        string $name,
        protected readonly string $login,
        protected readonly string $password,
        protected int $age
    ) {
        parent::__construct($name);
        ++static::$count;
    }

    public function __destruct()
    {
        --static::$count;
    }

    public static function create(string $login, string $password, int $age): static
    {
        return new static($login, $password, $age);
    }

    public static function count(): int
    {
        return static::$count;
    }

    public function auth(string $login, string $password): bool
    {
        foreach ($this->vehicles as $vehicle) {
            assert($vehicle instanceof StartableInterface);
            $vehicle->start();
            if ($vehicle instanceof Car) {

            }
        }
        if ($this->login !== $login || $this->password !== $password) {
            throw new \InvalidArgumentException("Auth failed!");
        }

        return true;
    }

    public function addVehicle(StartableInterface $vehicle): void
    {
        $this->vehicles[] = $vehicle;
    }
}

//$member = new Member('Ben', 'Ben', 'pass', 35);
//$member = Member::create('Ben', 'admin', 35);
//echo Member::count() - 2

//try {
//    $member->auth('Ben', 'admin');
//} catch (\InvalidArgumentException $e) {
//    echo $e->getMessage();
//}
