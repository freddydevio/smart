<?php

namespace Core;

use Core\Database\Connection;
use Core\Modules\Modules;
use Core\Routing\Dispatcher;
use Core\Routing\Router;
use Core\Services\ServiceRegisterer;

class Bootstrap
{
    /** @var DependencyInjector $dependencyInjector */
    private $dependencyInjector;

    function __construct(DependencyInjector $dependencyInjector)
    {
        $this->dependencyInjector = $dependencyInjector;
        $this->registerDispatcher();
        $this->registerConfig();
        $this->registerDatabase();
        $this->registerModules();
        $this->registerRouter();
        $this->registerServices();
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

    protected function registerServices()
    {
        $services = [
            'FormBuilderService' => 'Core\Services\FormBuilderService',
            'GridService' => 'Core\Services\GridService',
            'ConfigService' => 'Core\Services\ConfigService',
            'LessCompilerService' => 'Core\Services\LessCompilerService',
            'ContextService' => 'Core\Services\ContextService',
            'IntentsCollectorService' => 'Core\Services\IntentsCollectorService',
            'WeatherDataService' => 'App\Modules\Weather\Services\WeatherDataService',
            'ClockDataService' => 'App\Modules\Clock\Services\ClockDataService',
        ];

        foreach ($services as $serviceName => $serviceClass) {
            $this->dependencyInjector->register($serviceName, new $serviceClass);
        }
    }
}
