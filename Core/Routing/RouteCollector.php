<?php

namespace Core\Routing;

use Core\Database\Connection;
use Core\DependencyInjector;

class RouteCollector
{
    /** @var array $routes */
    private $routes = [];
    /** @var Connection $database */
    protected $database;
    /** @var DependencyInjector $dependencyInjection */
    protected $dependencyInjection;

    function __construct()
    {
        $this->dependencyInjection = DependencyInjector::getInstance();
        $this->database = $this->dependencyInjection->getService('database');
    }

    public function getRoutes()
    {
        $this->getInternalRoutes();
        $this->getRoutesFromModules();

        return $this->routes;
    }

    private function getInternalRoutes()
    {
        $routes = include_once (APPLICATION_ROOT . '/Core/routes.php');

        foreach ($routes as &$route) {
            $route['namespace'] = 'Core';
        }

        $this->routes = array_merge($this->routes, $routes);
    }

    private function getRoutesFromModules()
    {
        $conn = $this->database->getDB();
        $modules = $conn->query(
            'SELECT * FROM modules'
        )->fetchAll(\PDO::FETCH_ASSOC);

        foreach ($modules as $module) {
            require_once $module['path'];

            $moduleBootstrap = '\\' . $module['name'] . '\\Bootstrap';
            $bootstrap = new $moduleBootstrap;
            $routes = $bootstrap->getRoutes();

            foreach ($routes as &$route) {
                $route['namespace'] = 'App\Modules\\'.$module['name'];
            }

            $this->routes = array_merge($this->routes, $routes);
        }
    }
}