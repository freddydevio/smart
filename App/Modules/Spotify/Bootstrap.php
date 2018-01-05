<?php

namespace Spotify;

use Core\Modules\ModuleBootstrap;

class Bootstrap implements ModuleBootstrap
{
    protected $name = 'Spotify';

    public function getModuleName()
    {
        return $this->name;
    }

    public function getRoutes()
    {
        return [
            'spotify/index' => ['controller' => 'SpotifyController', 'action' => 'index'],
        ];
    }
}