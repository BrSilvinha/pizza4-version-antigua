<?php

class Session
{
    private static $mock;

    public static function setMock($mock)
    {
        self::$mock = $mock;
    }

    public static function init()
    {
        if (self::$mock) {
            return self::$mock->init();
        }
        // Código original para inicializar la sesión...
        session_start();
    }

    public static function get($key)
    {
        if (self::$mock) {
            return self::$mock->get($key);
        }
        // Código original para obtener el valor de la sesión...
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    public static function set($key, $value)
    {
        if (self::$mock) {
            return self::$mock->set($key, $value);
        }
        // Código original para establecer el valor de la sesión...
        $_SESSION[$key] = $value;
    }

    public static function destroy()
    {
        if (self::$mock) {
            return self::$mock->destroy();
        }
        // Código original para destruir la sesión...
        session_destroy();
    }
}