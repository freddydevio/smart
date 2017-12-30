<?php

namespace Core;

class Application
{
    private $router;

    function __construct()
    {
        $this->router = new Router();
    }

    public function run()
    {
        $this->init();
        $this->initRoutes();
        $this->dispatch();

        session_start();
    }

    private function init()
    {
        define('DS', DIRECTORY_SEPARATOR);
        define('ROOT', dirname(dirname(__FILE__)));
        define('BASE_URL', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']);
        define('ASSETS_DIRECTORY', ROOT . DS . 'App/Assets');
    }

    private function initRoutes()
    {
        // Add the routes
        $this->router->add('', ['controller' => 'Index', 'action' => 'index']);
        $this->router->add('posts/index', ['controller' => 'Posts', 'action' => 'index']);
    }

    private function dispatch()
    {
        $this->router->dispatch($_SERVER['QUERY_STRING']);
    }
}