<?php

namespace Core\Services;

use Core\DependencyInjector;

class AdminContext
{
    /** @var DependencyInjector $serviceContainer */
    protected $serviceContainer;

    function __construct()
    {
        $this->serviceContainer = DependencyInjector::getInstance();
        $this->serviceContainer->register('adminContext', $this);
    }

    public function getModules()
    {
        return $this->serviceContainer->getService('modules')->getListModules();
    }

}