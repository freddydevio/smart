<?php

namespace Core;

/**
 * Class ServiceManager
 * @package Core
 */
class ServiceManager
{
    /**
     * @param $service
     * @return mixed
     */
    public function getService($service)
    {
        $service = new $service;
        return $service;
    }
}