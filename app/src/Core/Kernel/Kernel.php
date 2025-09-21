<?php

namespace App\Core\Kernel;

use Dotenv\Dotenv;
use App\Core\Database\Database;
use Config\Config;

class Kernel
{
    private static $config = [];
    private $db = null;

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

    private function initDatabase()
    {
        self::$config['database'] = (new Config())->getConfig();
        $this->db = (new Database(self::$config['database']['database']))->getConnection();
    }
}
