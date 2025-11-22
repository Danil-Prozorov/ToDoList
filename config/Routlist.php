<?php

namespace Config;

use App\Core\Router\Middleware\AuthMiddleware;
use App\Controllers\AuthController;

class Routlist
{
    public function getRouteList(): array
    {
        return [
            'get' => [
                '/' => ['/','PublicController', 'index'],
                '/news' => ['/news','PublicController', 'show'],
                '/login' => ['/login',new AuthController(), 'loginView'],
                '/register' => ['/register',new AuthController(), 'registerView'],
                '/tasks' => ['/tasks','TasksController','index', [new AuthMiddleware()]],
                '/tasks/create' => ['/tasks/create','TasksController', 'create', [new AuthMiddleware()]],
                '/tasks/{id}/edit' => ['/tasks/{id}/edit','TasksController', 'edit', [new AuthMiddleware()]],
                '/tasks/{id}/delete' => ['/tasks/{id}/delete','TasksController', 'delete', [new AuthMiddleware()]],
                '/tasks/{id}' => ['/tasks/{id}','TasksController', 'show', [new AuthMiddleware()]],
            ],
            'post' => [
                '/' => ['PublicController'],
                '/login' => ['/login',new AuthController(), 'login'],
                '/register' => ['/register',new AuthController(), 'register'],
                '/tasks' => ['TasksController','index', [new AuthMiddleware()]],
                '/tasks/create' => ['TasksController', 'create', [new AuthMiddleware()]],
                '/tasks/{id}/edit' => ['TasksController', 'edit', [new AuthMiddleware()]],
                '/tasks/{id}/delete' => ['TasksController', 'delete', [new AuthMiddleware()]],
                '/tasks/{id}' => ['TasksController', 'show', [new AuthMiddleware()]],
            ],
        ];
    }
}
