<?php

namespace App\Core\Router;

use App\Core\Http\Request;
//use App\Core\Http\Response;
use Config\Config;
use Config\Routlist;
use App\Core\Router\Middleware\Interfaces\MiddlewareInterface;
use App\Core\Router\Middleware\MiddlewarePipeline;

class Router
{
    private $routes;
    private $request;
    private $url_params;

    public function __construct()
    {
        $this->routes = (new Routlist())->getRouteList();
        $this->request = new Request();
    }

    public function get($current): void
    {
        $matchRoute = $this->matchRoute($current, 'get');

        if (!$matchRoute) {
            $this->route404();
        }

        if(count($matchRoute['data']) >= 4 && !empty($matchRoute['data'][3])){
            (new MiddlewarePipeline())->handle($this->request,$matchRoute['data'][3]);
        }

        if(!empty($matchRoute['data'][0])){
            $this->url_params = $this->getUrlParams($current, $matchRoute['data'][0]);
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

    private function convertRouteToPattern($route): string
    {
        $pattern = str_replace('/', '\/', $route);
        $pattern = preg_replace('/\{(\w+)\}/', '(\w+)', $pattern);

        return '#^' . $pattern . '$#';
    }

    private function getUrlParams($url,$pattern) : array
    {
        return array_values(array_diff(explode('/', $url), explode('/', $pattern)));
    }

    public function redirect($to): void
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
