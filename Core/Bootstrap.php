<?php

namespace Core;

use Core\Database\Connection;
use Core\Modules\Modules;
use Core\Routing\Dispatcher;
use Core\Routing\Router;

class Bootstrap
{
    /** @var DependencyInjector $dependencyInjector */
    private $dependencyInjector;

    function __construct(DependencyInjector $dependencyInjector)
    {
        $this->dependencyInjector = $dependencyInjector;
        $this->registerRouter();
        $this->registerDispatcher();
        $this->registerConfig();
        $this->registerDatabase();
        $this->registerModules();
    }

    protected function registerRouter()
    {
        $this->dependencyInjector->register('router', new Router());
    }

    protected function registerDispatcher()
    {
        $this->dependencyInjector->register('dispatcher', new Dispatcher());
    }

    protected function registerConfig()
    {
        $this->dependencyInjector->register('config', new Config());
    }

    protected function registerDatabase()
    {
        $this->dependencyInjector->register('database', new Connection());
    }

    protected function registerModules()
    {
        $this->dependencyInjector->register('modules', new Modules());
    }
}
