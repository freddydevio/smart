<?php

namespace App\Services;

use Core\Database;
use Core\Router;

class Installer
{
    /** @var null|\PDO $db */
    private $db;

    function __construct()
    {
        $database = new Database();
        $this->db = $database->getDB();
    }

    public function isAlreadyInstalled()
    {
        $exists = $this->db->query("SHOW TABLES LIKE 'routes'")->fetch();
        if(!$exists) {
            return false;
        }

        return true;
    }

    public function installBaseRoutes()
    {
        $router = new Router();
        $router->add('', ['controller' => 'SmartMirrorController', 'action' => 'index']);
        $router->add('install', ['controller' => 'InstallController', 'action' => 'index']);
        $router->add('install/settings', ['controller' => 'InstallController', 'action' => 'settings']);
        $router->add('install/finish', ['controller' => 'InstallController', 'action' => 'finish']);
    }

    public function installBaseTables()
    {
        $installerSql = file_get_contents(APPLICATION_ROOT . '/installer/install.sql');
        $installerStmts = explode(';', trim($installerSql));

        foreach ($installerStmts as $installerStmt) {
            if(!empty($installerStmt)) {
                $this->db->exec($installerStmt);
            }
        }
    }

    public function uninstall()
    {
        $installerSql = file_get_contents(APPLICATION_ROOT . '/installer/uninstall.sql');
        $installerStmts = explode(';', trim($installerSql));

        foreach ($installerStmts as $installerStmt) {
            if(!empty($installerStmt)) {
                $this->db->exec($installerStmt);
            }
        }
    }


}