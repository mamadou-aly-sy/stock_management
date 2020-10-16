<?php

namespace App\Models;

use Core\Database;
use Core\Model;

class Admin extends Model
{
    public $id;
    public $firstname;
    public $lastname;
    public $username;
    public $password;

    public static function login($username, $password)
    {
        return Database::query(
            "SELECT * FROM admins WHERE username = ? AND password = ?",
            [$username, $password],
            true,
            Admin::class
        );
    }
}
