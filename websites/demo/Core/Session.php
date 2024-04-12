<?php

namespace Core;

class Session
{
    private const SESSION_FLASH = '_flash';

    public static function put($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function get($key, $default = null)
    {
        return $_SESSION[self::SESSION_FLASH][$key] ?? $_SESSION[$key] ?? $default;
    }

    public static function has($key)
    {
        return (bool) static::get($key);
    }

    public static function flash($key, $value)
    {
        $_SESSION[self::SESSION_FLASH][$key] = $value;
    }

    public static function getFlash($key, $default = null)
    {
        return $_SESSION[self::SESSION_FLASH][$key] ?? $default;
    }

    public static function unflash($key = null)
    {
        if ($key === null) {
            unset($_SESSION[self::SESSION_FLASH]);
        } else {
            unset($_SESSION[self::SESSION_FLASH][$key]);
        }
    }

    public static function flush()
    {
        $_SESSION = [];
    }

    public static function destroy()
    {
        self::flush();

        session_destroy();

        $params = session_get_cookie_params();
        setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }
}
