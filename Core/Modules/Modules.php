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

    public function getModule($id)
    {
        $conn = $this->database->getDB();

        $stmt = $conn->prepare('SELECT * FROM modules WHERE id = :id');
        $stmt->bindParam(':id', $id);

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
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
        require $moduleBootstrapPath;

        $pathParts = explode('/', str_replace('.zip', '', $file));

        $moduleBootstrap = '\\' . $pathParts[count($pathParts)-1] . '\\Bootstrap';
        $bootstrap = new $moduleBootstrap;

        return [
            'name' => $bootstrap->getModuleName(),
            'routes' => $bootstrap->getRoutes(),
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