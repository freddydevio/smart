<?php

namespace News;

use Core\Modules\ModuleBootstrap;

class Bootstrap implements ModuleBootstrap
{
    protected $name = 'News';

    public function getModuleName()
    {
        return $this->name;
    }

    public function getRoutes()
    {
        return [
            'news/getData' => [
                'controller' => 'NewsController',
                'action' => 'getData'
            ]
        ];
    }

    public function getConfig()
    {
        return [
        ];
    }
}