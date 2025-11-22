<?php

namespace Config;

use App\Core\Router\Middleware\AuthMiddleware;

class Routlist
{
    public function getRouteList(): array
    {
        return [
            'get' => [
                '/' => ['/','PublicController', 'index'],
                '/news' => ['/news','PublicController', 'show'],
                '/login' => ['/login','AuthController', 'login'],
                '/register' => ['/register','AuthController', 'register'],
                '/tasks' => ['/tasks','TasksController','index', [new AuthMiddleware()]],
                '/tasks/create' => ['/tasks/create','TasksController', 'create', [new AuthMiddleware()]],
                '/tasks/{id}/edit' => ['/tasks/{id}/edit','TasksController', 'edit', [new AuthMiddleware()]],
                '/tasks/{id}/delete' => ['/tasks/{id}/delete','TasksController', 'delete', [new AuthMiddleware()]],
                '/tasks/{id}' => ['/tasks/{id}','TasksController', 'show', [new AuthMiddleware()]],
            ],
            'post' => [
                '/' => ['PublicController'],
                '/tasks' => ['TasksController','index', [new AuthMiddleware()]],
                '/tasks/create' => ['TasksController', 'create', [new AuthMiddleware()]],
                '/tasks/{id}/edit' => ['TasksController', 'edit', [new AuthMiddleware()]],
                '/tasks/{id}/delete' => ['TasksController', 'delete', [new AuthMiddleware()]],
                '/tasks/{id}' => ['TasksController', 'show', [new AuthMiddleware()]],
            ],
        ];
    }
}
