<?php

namespace Services\Controller;

use Db\Query;
use Services\Http\Response;
use Twig\Environment;

abstract class BaseController
{
    public function __construct(
        protected readonly Environment $twig,
        protected readonly Query $query
    ) {}

    protected function render(string $templateName, array $context = []): Response
    {
        return new Response($this->twig->render($templateName, $context));
    }
}
