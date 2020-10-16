<?php

namespace Core;

use InvalidArgumentException;

/**
 * Session Class
 * @package Core
 */
class Session
{
    /**
     * Get a session value
     *
     * @param string $key
     * @return string|null
     */
    public static function get($key): ?string
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    /**
     * Set a session value
     *
     * @param string $key
     * @param string $value
     * @return void
     */
    public static function set($key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Remove a session key
     *
     * @param string $key
     * @return void
     */
    public static function remove($key): void
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        } else {
            throw new InvalidArgumentException("no $key in the session");
        }
    }

    /**
     * Cheking if a session key exist
     *
     * @param string $key
     * @return boolean
     */
    public static function contain($key): bool
    {
        if (isset($_SESSION[$key])) {
            return true;
        }
        return false;
    }

    /**
     * Destroy the current Session
     *
     * @return void
     */
    public static function destroy(): void
    {
        session_destroy();
    }
}
