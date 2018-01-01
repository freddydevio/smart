<?php

namespace Core;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

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
        define('ASSETS_DIRECTORY', '/App/Assets');
    }

    private function initRoutes()
    {
//        // Add the routes
//        $this->router->add('index/index',
//            ['controller' => 'Index', 'action' => 'index']);
////        $this->router->add('smartmirror/index',
////            ['controller' => 'SmartMirror', 'action' => 'index']);
////        $this->router->add('admin/index',
////            ['controller' => 'Admin', 'action' => 'index']);
////        $this->router->add('plugins/list',
////            ['controller' => 'Plugins', 'action' => 'list']);
//
//        var_dump($this->router->getRoutes());

    }

    private function dispatch()
    {
        $this->router->dispatch($_SERVER['QUERY_STRING']);
    }
}