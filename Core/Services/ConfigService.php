<?php

namespace Core\Services;

use Core\Database\Connection;
use Core\DependencyInjector;

class ConfigService
{
    public function getModuleConfig($key, $default = '')
    {
        /** @var DependencyInjector $serviceContainer */
        $serviceContainer = DependencyInjector::getInstance();
        /** @var Connection $database */
        $database = $serviceContainer->getService('database');
        $conn = $database->getDB();

        $stmt = $conn->prepare('SELECT value FROM smart.module_config WHERE name = :key');
        $stmt->bindParam(':key', $key);
        $stmt->execute();

        $result = $stmt->fetch(\PDO::FETCH_COLUMN);

        if(!$result) {
            return $default;
        }

        return $result;
    }

    public function getGeneralConfig($key, $default = '')
    {
        /** @var DependencyInjector $serviceContainer */
        $serviceContainer = DependencyInjector::getInstance();
        /** @var Connection $database */
        $database = $serviceContainer->getService('database');
        $conn = $database->getDB();

        $stmt = $conn->prepare('SELECT value FROM smart.general_settings WHERE `key` = :key');
        $stmt->bindParam(':key', $key);
        $stmt->execute();

        $result = $stmt->fetch(\PDO::FETCH_COLUMN);

        if(!$result) {
            return $default;
        }

        return $result;
    }
}