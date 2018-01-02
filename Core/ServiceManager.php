<?php

namespace Core;

class ServiceManager
{
    public function getService($serviceName)
    {
        $class = 'App\Services\\'.$serviceName;
        $service = new $class;
        return $service;
    }
}