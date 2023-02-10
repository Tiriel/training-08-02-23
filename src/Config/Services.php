<?php

namespace Config;

use Db\{Connection,Query};
use Services\Http\Authentication;
use Services\Routing\Router;

class Services
{
    protected static array $definitions = [
        Authentication::class => [],
        Connection::class => [],
        Router::class => [],
        Query::class => [Connection::class, 20],
    ];
    public static function get(string $className): array
    {
        return static::$definitions[$className];
    }
}
