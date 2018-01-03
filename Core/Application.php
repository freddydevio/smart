<?php

namespace Core;

use Dotenv\Dotenv;

class Application
{
    /** @var Router $router */
    protected $router;

    public function __construct()
    {
        $this->router = new Router();

        $this->initRoutes();
        $this->initEnvFiles();
        $this->dispatchRoute();
    }

    protected function initRoutes()
    {
        $this->router->add('', ['controller' => 'SmartMirrorController', 'action' => 'index']);
        $this->router->add('news', ['controller' => 'NewsController', 'action' => 'index']);
        $this->router->add('reminders', ['controller' => 'ReminderController', 'action' => 'index']);
    }

    protected function initEnvFiles()
    {
        $dotenv = new Dotenv(CONFIG_ROOT);
        $dotenv->load();
    }

    protected function dispatchRoute()
    {
        $this->router->dispatch($_SERVER['QUERY_STRING']);
    }
}