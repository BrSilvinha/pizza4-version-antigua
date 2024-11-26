<?php

class Session
{
    public static function init()
    {
        if (session_status() == PHP_SESSION_NONE) {
            if (!self::isSessionEnabled()) {
                die("Las sesiones no están habilitadas en el servidor.");
            }
            session_start();
        }
    }

    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function get($key)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    public static function remove($key)
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    public static function destroy()
    {
        session_destroy();
        $_SESSION = [];
    }

    private static function isSessionEnabled()
    {
        return function_exists('session_start');
    }
}
