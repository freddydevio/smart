<?php

namespace Core\Routing;

use Core\DependencyInjector;

class Dispatcher
{
    /** @var string $query */
    protected $query;
    /** @var string $namespace */
    protected $namespace;
    /** @var string $controller */
    protected $controller;
    /** @var string $action */
    protected $action;
    /** @var string $parameter */
    protected $parameter;
    /** @var DependencyInjector $dependencyInjector */
    protected $dependencyInjector;

    function __construct()
    {
        $this->dependencyInjector = DependencyInjector::getInstance();
    }

    public function dispatch($query)
    {
        $this->query = $query;
        $this->matchQueryWithRoutes();

        $action = $this->action;
        $namespace = $this->namespace . '\Controllers\\';
        $controller = $this->convertToStudlyCaps($this->controller);
        $controller = $namespace . $controller;

        if (class_exists($controller)) {
            $controllerObj = new $controller;
            if (is_callable([$controllerObj, $action])) {
                $action = $this->convertToCamelCase($action);
                $beforeAction =  'before'.ucfirst($action);
                $afterAction =  'after'.ucfirst($action);
                $controllerObj->preDispatch();
                if (method_exists($controllerObj, $beforeAction)) {
                    $controllerObj->$beforeAction();
                }
                $controllerObj->$action($this->parameter);
                if (method_exists($controllerObj, $afterAction)) {
                    $controllerObj->$afterAction();
                }
                $controllerObj->postDispatch();
            } else {
                throw new \Exception("Method $action (in controller $controller) not found");
            }
        } else {
            throw new \Exception("Controller class $controller not found");
        }
    }

    public function matchQueryWithRoutes()
    {
        if (empty($this->query)) {
            //url empty set fallback
            $fallback = $this->getFallbackRouter();
            $this->namespace = $fallback['namespace'];
            $this->controller = $fallback['controller'];
            $this->action = $fallback['action'];
        } else {
            $urlParts = explode('/', $this->query);
            $controller = $urlParts[0];
            $action = (!empty($urlParts[1])) ? $urlParts[1] :'index';
            $parameter = (!empty($urlParts[2])) ? $urlParts[2] : null;
            $tmpUrl = $controller . '/' . $action;

            foreach ($this->getRoutes() as $path => $route) {
                if($path == $tmpUrl) {
                    $this->namespace = $route['namespace'];
                    $this->controller = $route['controller'];
                    $this->action = $route['action'];
                    $this->parameter = $parameter;
                }
            }

            //Basic logic
            //$this->controller = $urlParts[0];
            //$this->action = (!empty($urlParts[1])) ? $urlParts[1] :'index';
        }
    }

    protected function getRoutes()
    {
        /** @var Router $router */
        $router = $this->dependencyInjector->getService('router');
        return $router->getRoutes();
    }

    protected function convertToStudlyCaps($string)
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
    }

    protected function convertToCamelCase($string)
    {
        return lcfirst($this->convertToStudlyCaps($string));
    }

    private function getFallbackRouter()
    {
        return [
            'namespace' => 'Core',
            'controller' => 'Index',
            'action' => 'index'
        ];
    }
}