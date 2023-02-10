<?php

namespace Services\Routing\Exception;

use Services\Routing\Route;

class NotFoundHttpException extends HttpException
{
    public function __construct(Route $route)
    {
        $message = sprintf("The requested url %s does not exist.", $route->getPath());

        parent::__construct($message, 404);
    }
}
