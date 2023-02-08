<?php

class Member implements AuthInterface
{
    protected static int $count = 0;

    protected array $vehicles = [];

    public function __construct(
        protected readonly string $login,
        protected readonly string $password,
        protected int $age
    ) {
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
        }
        return $this->login === $login && $this->password === $password;
    }

    public function addVehicle(StartableInterface $vehicle): void
    {
        $this->vehicles[] = $vehicle;
    }
}

//$member = new Member('Ben', 'pass', 35);
//$member = Member::create('Ben', 'admin', 35);
//echo Member::count() - 2
