<?php

namespace Member;

class Admin extends Member
{
    protected static int $count = 0;
    private AdminLevels $level;
    private bool $active;

    public function __construct(string $name, string $login, string $password, int $age, string $level = 'ADMIN', bool $active = true)
    {
        parent::__construct($name, $login, $password, $age);
        $this->level = AdminLevels::tryFrom($level);
        $this->active = $active;
    }

    public function auth(string $login, string $password): bool
    {
        if ($this->level === AdminLevels::SUPERADMIN) {
            return true;
        }

        return parent::auth($login, $password);
    }
}

//$admin = new Admin('Ben', 'Ben', 'password', 35, active: false);
//echo $admin;
// Exception!
