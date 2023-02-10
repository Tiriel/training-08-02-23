<?php

namespace App;

use Services\Http\Request;
use Services\Http\Response;
use Services\Routing\Router;
use Twig\Environment;

class Blog
{
    protected Container $container;
    protected mixed $twig;

    public function __construct()
    {
        $this->container = new Container();
        $this->twig = $this->container->get(Environment::class);
    }

    public function handle(Request $request): Response
    {
        $router = $this->container->get(Router::class);
        /** @var Router $router */
        $route = $router->route($request);
        if ('' === $controller = $this->container->get($route->getController())) {
            throw match ($route->getName()) {};
        }

        $response = $controller(...$request->getAttributes());

        // return $response;
        return new Response();
    }
}
