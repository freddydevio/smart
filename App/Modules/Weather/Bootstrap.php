<?php

namespace Weather;

use Core\Modules\ModuleBootstrap;

class Bootstrap implements ModuleBootstrap
{
    protected $name = 'Weather';

    public function getModuleName()
    {
        return $this->name;
    }

    public function getRoutes()
    {
        return [
            'weather/index' => ['controller' => 'WeatherController', 'action' => 'index'],
        ];
    }

    public function getConfig()
    {
        return [
            'weather_city' => [
                'placeholder' => 'Stadt',
                'type' => 'text',
                'helpText' => 'Stadt:'
            ]
        ];
    }
}