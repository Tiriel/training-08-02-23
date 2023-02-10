<?php

namespace Services\Routing;

use Services\Http\Request;
use Services\Routing\Exception\BadMethodHttpException;

class Router
{

    public function __construct(
        private readonly iterable $routes
    ) {}

    public function route(Request $request): Route
    {
        foreach ($this->routes as $route) {
            /** @var Route $route */
            if (!$this->match($request, $route)) {
                continue;
            }

            if (!\in_array($request->getMethod(), $route->getMethods())) {
                return new Route('error_bad_method', '/405');
            }

            return $route;
        }

        return new Route('error_not_found', '/404');
    }

    public function match(Request $request, Route $route): bool
    {
        $regex = $this->getPathRegex($route);

        if (preg_match($regex, $request->getPath(), $matches)) {
            $request->setAttributes($matches);

            return true;
        }

        return false;
    }

    public function getPathRegex(Route $route): string
    {
        $regex = $route->getPath();
        $requirements =$route->getRequirements();

        $regex = preg_replace_callback(
            '#{(\w+)}#',
            function ($matches) use ($requirements) {
                $req = $requirements[$matches[1]] ?? '.*';

                return "(?<{$matches[1]}>{$req})";
            },
            $regex
        );

        return "#^{$regex}$#";
    }
}
