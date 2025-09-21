<?php

namespace App\Core\Database;

use PDO;
use PDOException;

class Database
{
    private $connection;
    private $config;

    public function __construct(array $conn)
    {
        $this->config['dsn'] = $conn['DB_TYPE'].':host='.$conn['DB_HOST'].';port='.$conn['DB_PORT'].";dbname=".$conn['DB_NAME'];
        $this->config['user_db'] = ['user' => $conn['DB_USER'], 'pass' => $conn['DB_PASS']];
        self::initConnect($this->config['dsn'], $this->config['user_db']);
    }

    public function getConnection(){
        return $this->connection;
    }

    private function initConnect(string $connection, $login): void
    {
        try {
            $this->connection = new PDO($connection, $login['user'], $login['pass']);
        } catch (PDOException $e) {
            throw new PDOException("Connection failed: ".$e->getMessage());
        }
    }
}
