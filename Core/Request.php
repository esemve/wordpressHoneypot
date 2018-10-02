<?php

namespace Core;

class Request
{

    /**
     * @var string
     */
    protected $ip;

    /**
     * @var string
     */
    protected $uri;

    /**
     * @var string
     */
    protected $method;

    /**
     * @var string
     */
    protected $query;

    public function __construct(array $request)
    {
        $this->ip = $_SERVER['REMOTE_ADDR'];
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->uri = trim('/',trim($_SERVER['REQUEST_URI']));
        $this->query = $_SERVER['QUERY_STRING'] ?? null;

        if ($this->uri==='') {
            $this->uri = '/';
        }
    }

    public function isGet(): bool
    {
        return $this->method === 'GET';
    }

    public function getIp(): string
    {
        return $this->ip;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function hasQuery(): bool
    {
        return !empty($this->query);
    }
}