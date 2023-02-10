<?php

namespace Training\Member;

interface AuthInterface
{
    public function auth(string $login, string $password): bool;
}
