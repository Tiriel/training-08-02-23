<?php

namespace App;

use Services\Http\Request;
use Services\Http\Response;
use Services\Routing\Exception\BadMethodHttpException;
use Services\Routing\Exception\HttpException;
use Services\Routing\Exception\NotFoundHttpException;
use Services\Routing\Route;
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
        if ('error' === $controller = $route->getController()) {
            $this->throwHttpException($route);
        }

        $controller = $this->container->getController($controller);
        $action = $route->getAction();


        return $controller->$action(...$request->getAttributes());
    }

    private function throwHttpException(Route $route): void
    {
        throw match ($route->getName()) {
            'error_bad_method' => new BadMethodHttpException($route),
            'error_not_found' => new NotFoundHttpException($route),
            default => new HttpException()
        };
    }
}
