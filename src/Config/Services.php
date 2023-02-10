<?php

namespace Config;

use Db\{Connection,Query};
use Services\Controller\BaseController;
use Services\Http\Authentication;
use Services\Routing\Router;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Services implements ConfigInterface
{
    protected static array $definitions = [];

    public static function get(string $className = ''): array
    {
        if (empty(static::$definitions)) {
            static::initDefinitions();
        }

        if (!array_key_exists($className, static::$definitions)) {
            throw new \RuntimeException(sprintf("The requested service %s is not defined for Container use.", $className));
        }

        return static::$definitions[$className];
    }

    public static function initDefinitions(): void
    {
        static::$definitions = [
            BaseController::class => [Environment::class, Query::class],
            Router::class => [Routes::get()],
            Connection::class => Db::get(),
            Query::class => [Connection::class, 20],
            Environment::class => [FilesystemLoader::class],
            FilesystemLoader::class => [Templating::get('loader_paths')]
        ];
    }
}
