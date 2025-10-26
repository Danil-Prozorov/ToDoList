<?php

namespace App\Core\Router;

use App\Core\Http\Request;
//use App\Core\Http\Response;
use Config\Config;
use Config\Routlist;
use App\Core\Router\Middleware\Interfaces\MiddlewareInterface;

class Router
{
    private $routes;

    public function __construct()
    {
        $this->routes = (new Routlist())->getRouteList();
    }

    public function get($current)
    {
        $matchRoute = $this->matchRoute($current, 'get');

        if (!$matchRoute) {
            $this->route404();
        }
    }

    public function post($current)
    {
        $matchRoute = $this->matchRoute($current, 'post');
        if (!$matchRoute) {
            $this->route404();
        }
    }

    private function matchRoute($url, $method)
    {

        if (isset($this->routes[$method][$url])) {
            return [
                'route' =>  $url,
                'data' => $this->routes[$method][$url]
            ];
        }

        $routes = $this->routes[$method];

        foreach ($routes as $route => $data) {
            $pattern = $this->convertRouteToPattern($route);


            if (preg_match($pattern, $url, $matches)) {
                return [
                  'route' => $url,
                  'data' => $data
                ];
            }

        }

        return null;

    }

    private function convertRouteToPattern($route)
    {
        $pattern = str_replace('/', '\/', $route);
        $pattern = preg_replace('/\{(\w+)\}/', '(\w+)', $pattern);

        return '#^' . $pattern . '$#';
    }

    public function redirect($to)
    {
        $host = ((new Config())->getConfig())['general']['HOST'];

        header("HTTP/1.1 301 Moved Permanently");
        header("Location: http://$host/$to");
    }

    private function route404(): void
    {
        $host = ((new Config())->getConfig())['general']['HOST'];

        header("HTTP/1.0 404 Not Found");
        header("Location: http://$host/404");
    }

}
