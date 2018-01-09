<?php

namespace Clock;

use Core\Modules\ModuleBootstrap;

class Bootstrap implements ModuleBootstrap
{
    protected $name = 'Clock';

    public function getModuleName()
    {
        return $this->name;
    }

    public function getRoutes()
    {
        return [];
    }

    public function getConfig()
    {
        return [
            'clock_timezone' => [
                'placeholder' => 'Zeitzone',
                'type' => 'text'
            ]
        ];
    }
}