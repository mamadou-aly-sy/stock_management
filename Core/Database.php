<?php

namespace Core;

use PDO;
use stdClass;

/**
 * Database Class
 */
class Database
{
    /**
     * Connexion Instance
     *
     * @var PDO
     */
    protected static $instance = null;

    /**
     * Getting Connexion instance
     *
     * @return PDO
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new PDO("mysql::host=" . config('database.host') . ";dbname=" . config('database.name'),
                config('database.user'),
                config('database.pswd'),
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
        }
        return self::$instance;
    }

    /**
     * Execute a sql query and return the result
     *
     * @param string $sqlRequest
     * @param array $parameters
     * @param boolean $onlyOne
     * @param string $className
     * @return mixed
     */
    public static function query(string $sqlRequest, array $parameters = null, bool $onlyOne = false, string $className = stdClass::class)
    {
        $pdo = self::getInstance();
        if (is_null($parameters)) {
            $query = self::getInstance()->query($sqlRequest);
            $query->setFetchMode(PDO::FETCH_CLASS, $className);
            if ($onlyOne) {
                return $query->fetch();
            }
            return $query->fetchAll();
        } else {
            $query = self::getInstance()->prepare($sqlRequest);
            $query->execute($parameters);
            $query->setFetchMode(PDO::FETCH_CLASS, $className);
            if ($onlyOne) {
                return $query->fetch();
            }
            return $query->fetchAll();
        }
    }

    /**
     * Execute sql request without returning any result
     *
     * @param string $sqlRequest
     * @param array $parameters
     * @return bool
     */
    public static function execute(string $sqlRequest, array $parameters = null)
    {
        $pdo = self::getInstance();
        if (is_null($parameters)) {
            $query = self::getInstance()->exec($sqlRequest);
            if ($query) {
                return true;
            }

            return false;
        } else {
            $query = self::getInstance()->prepare($sqlRequest);
            $query->execute($parameters);
            if ($query->rowCount() == 1) {
                return true;
            }

            return false;
        }
    }
}
