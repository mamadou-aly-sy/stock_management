<?php

namespace Core;

use App\Models\User;

class Auth
{
    public static function login($pseudo, $password): ?User
    {
        $user = Database::query(
            "SELECT * FROM " . User::generateTableName() . " WHERE pseudo = ? AND password = ?",
            [$pseudo, sha1($password)],
            true,
            User::class
        );
        if ($user) {
            Session::set('auth', $user->id);
            return $user;
        }
        return null;
    }

    public static function user()
    {
        if (Session::contain('auth')) {
            return User::find(Session::get('auth'));
        }
        return null;
    }

    public static function logout()
    {
        Session::remove('auth');
    }

    public static function isLoggedIn()
    {
        return Session::contain('auth');
    }

}
