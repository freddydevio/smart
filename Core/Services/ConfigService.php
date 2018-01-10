<?php

namespace Core\Services;

use Core\Database\Connection;
use Core\DependencyInjector;

/**
 * Class ConfigService
 * @package Core\Services
 */
class ConfigService
{
    /**
     * @param $key
     * @param string $default
     * @return mixed|string
     */
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

    /**
     * @param $key
     * @param string $default
     * @return mixed|string
     */
    public function getGeneralConfig($key, $default = '', $returnType = 'string')
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

        if(is_null($result)) {
            return $default;
        }

        switch ($returnType) {
            case ('string') :
                $result = strval($result);
                break;
            case ('int') :
                $result = intval($result);
                break;
            case ('bool') :
            case ('boolean'):
                $result = boolval($result);
                break;
        }

        return $result;
    }

    /**
     * @param $key
     * @param $value
     */
    public function saveConfig($key, $value)
    {
        /** @var DependencyInjector $serviceContainer */
        $serviceContainer = DependencyInjector::getInstance();
        /** @var Connection $database */
        $database = $serviceContainer->getService('database');
        $conn = $database->getDB();

        $stmt = $conn->prepare(
            'INSERT INTO smart.general_settings (`key`, `value`) 
              VALUES(:key, :value) 
                ON DUPLICATE KEY 
                UPDATE `key`=:key, `value`=:value'
        );
        $stmt->bindParam(':key', $key);
        $stmt->bindParam(':value', $value);
        $stmt->execute();
    }
}