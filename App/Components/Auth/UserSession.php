<?php

namespace App\Components\Auth;

class UserSession
{
    public static function startSession($login)
    {
        return $_SESSION['userLogin'] = $login;
    }

    public static function issetSession()
    {
        return $_SESSION['userLogin'] ?? null;
    }

    public static function unsetSession()
    {
        return $_SESSION['userLogin'] = null;
    }
}