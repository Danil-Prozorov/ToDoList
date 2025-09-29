<?php

namespace App\Core\Kernel;

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

    private function initRoutes()
    {

    }

    private function initDatabase(): PDO
    {
        try{
            return (new Database())->getConnection();
        }catch (PDOException $e){
            throw new PDOException("Database connection failed".$e->getMessage());
        }

    }
}
