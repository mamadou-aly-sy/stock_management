<?php

namespace Core;

/**
 * Autoloader Class
 * @package Mamadou\Core
 */
class Autoloader
{
    /**
     * Registering Autoloader
     *
     * @return void
     */
    public static function register(): void
    {
        spl_autoload_register([__CLASS__, 'autoload']);
    }

    /**
     * Automatique requirer Classname
     *
     * @param string $className
     * @return void
     */
    public static function autoload(string $className)
    {
        $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
        require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . $className . '.php';
    }
}
