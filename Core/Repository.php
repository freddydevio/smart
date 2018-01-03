<?php

namespace Core;

use PDO;

abstract class Repository
{

    protected static function getDB()
    {
        static $db = null;
        if ($db === null) {
            $dsn = 'mysql:host=' . getenv('DB_HOST') . ';dbname=' . getenv('DB_DATABASE') . ';charset=utf8';
            $db = new PDO($dsn, getenv('DB_USER'), getenv('DB_PASS'));
            // Throw an Exception when an error occurs
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return $db;
    }
}