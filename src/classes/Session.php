<?php

class Session
{
    public static function put($name, $value)
    {
        return $_SESSION[$name] = $value;
    }

    public static function exists($name)
    {
        return isset($_SESSION[$name]);
    }

    public static function delete($name)
    {
        if (self::exists($name)) {

            unset($_SESSION[$name]);
        }
    }

    public static function get($name)
    {
        return $_SESSION[$name];
    }

    public static function flash($name, $message = '')
    {
        if (self::exists($name) && self::get($name) != '') {
            $session = self::get($name);
            self::delete($name);
            return $session;
        } else {
            self::put($name, $message);
        }
    }
}
