<?php

namespace Core\Services;

use Core\Database\Connection;
use Core\DependencyInjector;
use Core\Modules\Modules;

/**
 * Class FormBuilderService
 * @package Core\Services
 */
class FormBuilderService
{
    /** @var DependencyInjector $serviceContainer */
    protected $serviceContainer;

    function __construct()
    {
        $this->serviceContainer = DependencyInjector::getInstance();
    }

    /**
     * @param $moduleId
     * @return array
     */
    public function createConfigForm($moduleId)
    {
        $configs = $this->getSettingsByModuleId($moduleId);

        foreach ($configs as $key => &$config) {
            $config['value'] = $this->getSettingsValueByConfigNameAndModuleId($key, $moduleId);
        }

        return $configs;
    }

    private function getSettingsValueByConfigNameAndModuleId($name, $id)
    {
        /** @var Connection $db */
        $db = $this->serviceContainer->getService('database');
        $conn = $db->getDB();
        $stmt = $conn->prepare('SELECT value FROM smart.module_config WHERE moduleId = :moduleId AND name = :name');
        $stmt->bindParam(':moduleId', $id);
        $stmt->bindParam(':name', $name);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_COLUMN);
    }

    /**
     * @param $id
     * @return array
     */
    private function getSettingsByModuleId($id)
    {
        /** @var Modules $moduleService */
        $moduleService = $this->serviceContainer->getService('modules');
        return $moduleService->getModuleConfigById($id);
    }
}