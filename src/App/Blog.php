<?php

namespace App;

use Services\Http\Request;
use Services\Http\Response;
use Services\Routing\Router;

class Blog
{
    protected Container $container;

    public function __construct()
    {
        $this->container = new Container();
    }

    public function handle(Request $request): Response
    {
        $router = $this->container->get(Router::class);
        /** @var Router $router */
        $route = $router->route($request);

        $controller = $this->container->get($route->getControllerName());

        $response = $controller();

        // return $response;
        return new Response();
    }
}
