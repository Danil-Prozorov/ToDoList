<?php

namespace Config;

use App\Core\Router\Middleware\AuthMiddleware;

class Routlist
{
    public function getRouteList(): array
    {
        return [
            'get' => [
                '/' => ['/','PublicController@index', 'index'],
                '/tasks' => ['/tasks','TasksController@index:Auth','index', new AuthMiddleware()],
                '/tasks/create' => ['/tasks/create','TasksController@create', 'create', new AuthMiddleware()],
                '/tasks/{id}/edit' => ['/tasks/{id}/edit','TasksController@edit', 'edit', new AuthMiddleware()],
                '/tasks/{id}/delete' => ['/tasks/{id}/delete','TasksController@delete', 'delete', new AuthMiddleware()],
                '/tasks/{id}' => ['/tasks/{id}','TasksController@show', 'show', new AuthMiddleware()],
            ],
            'post' => [
                '/' => ['PublicController@index'],
                '/tasks' => ['TasksController@index:Auth','index', new AuthMiddleware()],
                '/tasks/create' => ['TasksController@create', 'create', new AuthMiddleware()],
                '/tasks/{id}/edit' => ['TasksController@edit', 'edit', new AuthMiddleware()],
                '/tasks/{id}/delete' => ['TasksController@delete', 'delete', new AuthMiddleware()],
                '/tasks/{id}' => ['TasksController@show', 'show', new AuthMiddleware()],
            ],
        ];
    }
}
