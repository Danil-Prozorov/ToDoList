<?php

namespace App\Core\Kernel;

use Dotenv\Dotenv;

class Kernel
{
    public function run()
    {
        self::initBase();
        self::initRoutes();
        self::initDatabase();
    }

    private function initBase()
    {
        $dotenv = Dotenv::createImmutable("../");
        $dotenv->load();
    }

    private function initRoutes()
    {

    }

    private function initDatabase()
    {

    }
}
