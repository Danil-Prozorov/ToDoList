<?php

namespace App\Core\Router\Middleware\Interfaces;

use App\Core\Http\Request;

interface MiddlewareInterface
{
    public function handle(Request $request, callable $next);
}
