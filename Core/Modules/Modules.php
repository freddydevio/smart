<?php

namespace Core\Modules;

use Core\Database\Connection;
use Core\DependencyInjector;

class Modules
{
    /** @var Connection $database */
    protected $database;
    /** @var DependencyInjector $dependencyInjection */
    protected $dependencyInjection;

    function __construct()
    {
        $this->dependencyInjection = DependencyInjector::getInstance();
        $this->database = $this->dependencyInjection->getService('database');
    }

    public function getListModules($onlyActive = true)
    {
        $conn = $this->database->getDB();

        if (!$onlyActive) {
            $stmt = $conn->query('SELECT * FROM modules');
        } else {
            $stmt = $conn->query('SELECT * FROM modules WHERE active = true');
        }

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}