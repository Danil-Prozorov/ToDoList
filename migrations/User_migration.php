<?php

namespace Migrations;

use App\Core\Database\Database;
use PDOException;

class User_migration
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
        $this->db->getConnection();
    }
    public function up()
    {
        $this->db->createTable("users", [
            "id  INT NOT NULL AUTO_INCREMENT PRIMARY KEY",
            "username VARCHAR(255) NOT NULL",
            "email VARCHAR(255) NOT NULL",
            "password VARCHAR(255) NOT NULL",
            "user_token VARCHAR(255) NOT NULL",
            "user_status INT DEFAULT 0 NOT NULL",
            "is_admin boolean DEFAULT 0 NOT NULL",
            "last_active DATETIME",
            "created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP",
        ]);
    }

    public function down()
    {
        $this->db->dropTable("users");
    }
}
