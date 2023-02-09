<?php

namespace Patterns\Proxy;

use Member\Admin;
use Member\User;

class ProxyConnection extends Connection
{
    private array $cache = [];

    public function __construct(
        private Connection $connection,
        private User $user
    ) {}

    public function selectFromDb(string $tableName): array
    {
        if (isset($this->cache[$tableName]) && !empty($this->cache[$tableName])) {
            return $this->cache[$tableName];
        }

        return $this->cache[$tableName] = $this->connection->selectFromDb($tableName);
    }

    public function insertInDb(array $data): bool
    {
        if ($this->user instanceof Admin) {
            return $this->connection->insertInDb($data);
        }

        return false;
    }


}
