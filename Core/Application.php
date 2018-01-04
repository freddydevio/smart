<?php

namespace Core;

use App\Services\Installer;
use Dotenv\Dotenv;

class Application
{
    /** @var Router $router */
    protected $router;

    public function __construct()
    {
        $this->router = new Router();
        $serviceManager = new ServiceManager();

        $this->initEnvFiles();
        /** @var Installer $installer */
        $installer = $serviceManager->getService(Installer::class);
        $installer->uninstall();

        if(!$installer->isAlreadyInstalled()) {
            $installer->installBaseTables();
            $installer->installBaseRoutes();
            $this->router->dispatch('install');
        }else {
            $this->initRoutes();
            $this->dispatchRoute();
        }
    }

    protected function initRoutes()
    {

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