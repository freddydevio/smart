<?php

namespace Core;

use PDO;

abstract class Repository
{
    protected $table;

    public function __construct()
    {
        $this->checkTableExist();
    }

    private function checkTableExist()
    {
        $db = static::getDB();
        $exists = $db->query("SHOW TABLES LIKE '" . $this->table . "'")->fetch();
        if(!$exists) {
            $db->exec('CREATE TABLE '.$this->table.'(id INT NOT NULL PRIMARY KEY AUTO_INCREMENT)');
        }
    }

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