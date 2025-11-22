<?php

namespace App\Core\Kernel;

use App\Core\Router\Router;
use App\Core\Http\Request;
use Dotenv\Dotenv;
use App\Core\Database\Database;
use PDO;
use PDOException;

class Kernel
{
    public function run()
    {
        self::initBase();
        self::initRoutes();
        self::initDatabase();
    }

    private function initBase(): void
    {
        $dotenv = Dotenv::createImmutable("../");
        $dotenv->load();
    }

    private function initRoutes(): void
    {
        $request = new Request();
        $router = new Router();

        if ($request->getMethod() == 'GET') {
            $router->get($request->getUri());
        } elseif ($request->getMethod() == 'POST') {
            $router->post($request->getUri());
        }

    }

    private function initDatabase(): PDO
    {
        try {
            return (new Database())->getConnection();
        } catch (PDOException $e) {
            throw new PDOException("Database connection failed".$e->getMessage());
        }

    }
}
