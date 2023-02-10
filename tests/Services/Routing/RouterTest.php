<?php

namespace Tests\Services\Routing;

use Services\Http\Request;
use Services\Routing\Route;
use Services\Routing\Router;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{

    protected static Router $router;
    protected static array $routes = [];

    public static function setUpBeforeClass(): void
    {
        static::$routes[] = new Route('main_index', '/');
        static::$routes[] = new Route('main_page1', '/page1');
        static::$routes[] = new Route('post_show', '/post/{slug}');

        static::$router = new Router(static::$routes);
    }

    public function testMatch()
    {
        $request = Request::create([], [], ['request_uri' => '/', 'request_method' => 'GET']);
        $route = static::$router->match($request, static::$routes[0]);
        $this->assertSame(true, $route);
    }

    public function testMatchRouteWithAttribute()
    {
        $request = Request::create([], [], ['request_uri' => '/post/mon-premier-billet', 'request_method' => 'GET']);
        $route = static::$router->route($request);
        $this->assertSame('post_show', $route->getName());
        $this->assertArrayHasKey('slug', $request->getAttributes());
        $this->assertSame('mon-premier-billet', $request->getAttributes()['slug']);
    }

    public function testMatchFailed()
    {
        $request = Request::create([], [], ['request_uri' => '/', 'request_method' => 'GET']);
        $route = static::$router->match($request, static::$routes[1]);
        $this->assertSame(false, $route);
    }


    public function testRouteNotFound()
    {
        $request = Request::create([], [], ['request_uri' => '', 'request_method' => '']);
        $route = static::$router->route($request);
        $this->assertSame("error_not_found", $route->getName());
    }

}
