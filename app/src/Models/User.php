<?php

namespace App\Models;

use App\Core\Database\Database;
use PDO;
use PDOException;

class User
{
    public $id;
    public $username;
    public $email;
    public $user_staus;
    public $last_active;
    private $is_admin;
    private $token;
    private $password;
    private $db;

    public function __construct()
    {
        $db = (new Database())->getConnection();
    }

    public function getById()
    {

    }

    public function getByEmail()
    {

    }

    public function createUser()
    {

    }

    public function updateUser()
    {

    }

    public function deleteUser()
    {

    }
}