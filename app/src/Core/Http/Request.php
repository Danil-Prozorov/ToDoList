<?php

namespace App\Core\Http;

class Request
{
    private $request;
    private $server;

    public function __construct()
    {
        $this->request = $_REQUEST;
        $this->server = $_SERVER;
    }

    public function getRequestHeader()
    {
        return getallheaders();
    }

    public function getHeaderElement($name)
    {
        $headers = $this->getRequestHeader();
        return $headers[$name];
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function getMethod()
    {
        return $this->server['REQUEST_METHOD'];
    }

    public function getUri()
    {
        return $this->server['REQUEST_URI'];
    }

    public function getRequestParam($paramname)
    {
        return $this->server[$paramname];
    }
}
