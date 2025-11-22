<?php

namespace App\Core\Router\Middleware;

use App\Core\Router\Middleware\Interfaces\MiddlewareInterface as Middleware;
use App\Core\Http\Request;
use App\Core\Router\Router;

class AuthMiddleware implements Middleware
{
    public function handle(Request $request, callable $next)
    {

        if (!$this->isAuthorized($request)) {
            (new Router())->redirect("login");
        }

        return $request;
    }

    private function isAuthorized(Request $request): bool
    {
        $token = $request->getHeaderElement("Cookie");

        if (!str_contains($token, "user_token")) {
            return false;
        }

        return true;
    }
}
