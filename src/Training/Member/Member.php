<?php

namespace Training\Member;

use Training\Vehicle\StartableInterface;

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

    public static function create(array $data): static
    {
        $keys = ['name', 'login', 'password', 'age'];
        if (empty($data) || 0 !== count(array_diff($keys, array_keys($data)))) {
            throw new \InvalidArgumentException("You need all the proper keys.");
        }

        ['name' => $name, 'login' => $login, 'password' => $password, 'age' => $age] = $data;

        return new static($name, $login, $password, $age);
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
