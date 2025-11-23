<?php

namespace App\Core\Database;

use PDO;
use PDOException;
use Config\Config;

class Database
{
    private $connection;
    private $config;

    public function __construct()
    {
        $conn = (new Config())->getConfig();
        $this->config['dsn'] = $conn['database']['DB_TYPE'].':host='.$conn['database']['DB_HOST'].';port='.$conn['database']['DB_PORT'].";dbname=".$conn['database']['DB_NAME'];
        $this->config['user_db'] = ['user' => $conn['database']['DB_USER'], 'pass' => $conn['database']['DB_PASS']];
        self::initConnect($this->config['dsn'], $this->config['user_db']);
    }

    public function getConnection(): PDO
    {

        try {
            return $this->connection;
        } catch (PDOException $e) {
            throw new PDOException("Connection failed: ".$e->getMessage());
        }

    }

    public function createTable(string $table, array $fieldList): void
    {
        try {
            $columns = implode(', ', $fieldList);

            $query = "CREATE TABLE IF NOT EXISTS ".$table." (".$columns.")";
            $query = $this->connection->prepare($query);

            $query->execte();
        } catch (PDOException $e) {
            throw new PDOException("Table already exists: ".$table);
        }
    }

    public function dropTable(string $table): void
    {
        try {
            $this->connection->exec("DROP TABLE IF EXISTS ".$table);
        } catch (PDOException $e) {
            throw new PDOException("Table already down: ".$table);
        }
    }

    private function initConnect(string $connection, $login): void
    {
        try {
            $this->connection = new PDO($connection, $login['user'], $login['pass']);
        } catch (PDOException $e) {
            throw new PDOException("Connection failed: ".$e->getMessage());
        }
    }

    public function query(string $query)
    {

    }
}
