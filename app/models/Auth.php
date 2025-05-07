<?php

class Auth
{
    public static function validateCredentials($username, $password)
    {
        return $username === 'admin' && $password === 'secret';
    }

    public static function generateToken()
    {
        $token = bin2hex(random_bytes(32));
        $_SESSION['tokens'][$token] = time(); // Optionally store timestamp
        return $token;
    }

    public static function isValidToken($token)
    {
        return isset($_SESSION['tokens'][$token]);
    }
}
