<?php

namespace Core\Services;

use Core\Database\Connection;
use Core\DependencyInjector;

class GridService
{
    /** @var DependencyInjector $serviceContainer */
    protected $serviceContainer;

    function __construct()
    {
        $this->serviceContainer = DependencyInjector::getInstance();
    }

    public function getGridItems()
    {
        /** @var Connection $db */
        $db = $this->serviceContainer->getService('database');
        $conn = $db->getDb();
        $stmt = $conn->query('SELECT * FROM smart.grid');

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function saveGridPosition($id, $moduleId, $position)
    {

    }

    public function createBasicGrid()
    {
        /** @var Connection $db */
        $db = $this->serviceContainer->getService('database');
        $conn = $db->getDb();
        $conn->query('INSERT INTO smart.grid (moduleId, position, size) VALUES (1, 100, 1)')->execute();
    }
}