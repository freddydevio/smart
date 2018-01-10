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
        $sql = 'SELECT * FROM modules WHERE active = TRUE';

        if (!$onlyActive) {
            $sql = 'SELECT * FROM modules';
        }

        return $conn->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getModuleTemplateDirs()
    {
        $templateDirs = [];
        $modules = $this->getListModules(false);

        foreach ($modules as $module) {
            $templateDirs[] = APPLICATION_ROOT . '/App/Modules/' . $module['name'] . '/Resources/Templates/';
        }

        return $templateDirs;
    }

    public function getModule($id)
    {
        $conn = $this->database->getDB();

        $stmt = $conn->query('SELECT * FROM modules WHERE id = ' . $id);

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function getModuleConfigById($id)
    {
        $moduleData = $this->getModule($id);
        $moduleBootstrapNamespace = '\\' . $moduleData['name'] .'\\Bootstrap';

        require_once $moduleData['path'];

        $bootstrap = new $moduleBootstrapNamespace;

        return $bootstrap->getConfig();
    }

    public function saveModuleConfigByData($data)
    {
        $conn = $this->database->getDB();

        $moduleId = $data['moduleId'];
        unset($data['moduleId']);

        $stmt = $conn->prepare(
            'INSERT INTO smart.module_config (name, value, moduleId) 
              VALUES(:name, :value, :moduleId) 
                ON DUPLICATE KEY 
                UPDATE name=:name, value=:value, moduleId=:moduleId'
        );

        foreach ($data as $name => $value) {
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':value', $value);
            $stmt->bindParam(':moduleId', $moduleId);
            $stmt->execute();
        }
    }

    public function install($moduleFile)
    {
        $moduleData = $this->unzipArchive($moduleFile);
        $this->registerModule($moduleData);
    }

    private function unzipArchive($file)
    {
        $zipFile = new \ZipArchive();

        if($zipFile->open($file) === true) {
            $zipFile->extractTo(APPLICATION_ROOT . '/App/Modules/');
            $zipFile->close();
        }

        $moduleBootstrapPath = (str_replace('.zip', '', $file) . '/Bootstrap.php');
        require_once $moduleBootstrapPath;

        $pathParts = explode('/', str_replace('.zip', '', $file));

        $moduleBootstrap = '\\' . $pathParts[count($pathParts)-1] . '\\Bootstrap';
        $bootstrap = new $moduleBootstrap;

        return [
            'name' => $bootstrap->getModuleName(),
            'routes' => $bootstrap->getRoutes(),
            'config' => $bootstrap->getConfig(),
            'bootstrapPath' => $moduleBootstrapPath
        ];

    }

    private function registerModule($moduleData)
    {
        $conn = $this->database->getDB();

        $stmt = $conn->prepare(
            'INSERT INTO smart.modules (name, author, path) VALUES (:name, :author, :path)'
        );

        $stmt->bindParam(':name', $moduleData['name']);
        $stmt->bindValue(':author', 'Frederik Dengler');
        $stmt->bindParam(':path', $moduleData['bootstrapPath']);
        $stmt->execute();
    }
}