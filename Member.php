<?php

class Member
{
    public function __construct(
        private readonly string $login,
        private readonly string $password,
        private int $age
    ) {}

    public function auth(string $login, string $password): bool
    {
        return $this->login === $login && $this->password === $password;
    }
}

//$member = new Member('Ben', 'pass', 35);
