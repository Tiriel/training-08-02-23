<?php

class Admin extends Member
{
    protected static int $count = 0;
    private AdminLevels $level;

    public function __construct(string $login, string $password, int $age, string $level = 'ADMIN')
    {
        parent::__construct($login, $password, $age);
        $this->level = AdminLevels::tryFrom($level);
    }

    public function auth(string $login, string $password): bool
    {
        if ($this->level === AdminLevels::SUPERADMIN) {
            return true;
        }

        return parent::auth($login, $password);
    }
}

$admin = Admin::create('Ben', 'password', 35);
// Exception!
