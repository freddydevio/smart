<?php

namespace Core\Services;

use Core\Database\Connection;
use Core\DependencyInjector;

class ConfigService
{
    public function getModuleConfig($key)
    {
        /** @var DependencyInjector $serviceContainer */
        $serviceContainer = DependencyInjector::getInstance();
        /** @var Connection $database */
        $database = $serviceContainer->getService('database');
        $conn = $database->getDB();

        $stmt = $conn->prepare('SELECT value FROM smart.module_config WHERE name = :key');
        $stmt->bindParam(':key', $key);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_COLUMN);
    }
}