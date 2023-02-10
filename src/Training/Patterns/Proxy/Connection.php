<?php

namespace Training\Patterns\Proxy;

class Connection
{
    public function selectFromDb(string $tableName): array
    {
        // Make an actual request in DB

        return ['user' => uniqid()];
    }

    public function insertInDb(array $data): bool
    {
        // Make an actual insert in DB

        return true;
    }
}
