<?php

namespace Core;

use Dotenv\Dotenv;

class Config
{
    function __construct()
    {
        $this->registerGeneralConfig();
    }

    public function registerGeneralConfig()
    {
        $env = new Dotenv(CONFIG_ROOT, 'development.env');
        $env->load();
    }
}