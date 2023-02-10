<?php

namespace Services\Http;

class Response
{
    public function __construct(
        protected string $content,
        protected int $code = 200,
        protected array $headers = []
    ) {}

    public function send(): void
    {
        echo $this->content;
    }
}
