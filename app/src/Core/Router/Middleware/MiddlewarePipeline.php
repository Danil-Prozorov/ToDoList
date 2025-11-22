<?php

namespace App\Core\Router\Middleware;

use App\Core\Http\Request;

class MiddlewarePipeline
{
    private $middlewares = [];

    public function handle($request, $middleware)
    {
        $this->addMiddleware($middleware);

        $next = function ($request) {
            return false;
        };

        foreach (array_reverse($this->middlewares) as $middleware) {
            $next = function ($request) use ($middleware, $next) {
                return $middleware->handle($request, $next);
            };
        }

        return $next($request);
    }

    private function addMiddleware($middlewares): void
    {
        foreach ($middlewares as $middleware) {
            $this->middlewares[] = $middleware;
        }
    }
}
