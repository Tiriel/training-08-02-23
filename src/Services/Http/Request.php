<?php

namespace Services\Http;

class Request
{
    protected string $path;
    protected string $method;
    protected array $query = [];
    protected array $post = [];
    protected array $headers = [];
    protected array $server = [];

    private function __construct(array $query, array $post, array $server)
    {
        $server = array_change_key_case($server);
        $this->path = $server['request_uri'];
        $this->method = $server['request_method'];
        $this->query = $query;
        $this->post = $post;
        $this->server = $server;

        foreach ($server as $key => $value) {
            if (str_starts_with($key, 'http_')) {
                $this->headers[substr($key, 5)] = $value;
            } elseif (str_starts_with($key, 'content_')) {
                $this->headers[$key] = $value;
            }
        }
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getQuery(): array
    {
        return $this->query;
    }

    public function getPost(): array
    {
        return $this->post;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getServer(): array
    {
        return $this->server;
    }

    public static function create(): static
    {
        return new static($_GET, $_POST, $_SERVER);
    }
}
