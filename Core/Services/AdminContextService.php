<?php

namespace Core\Services;

use Core\DependencyInjector;

/**
 * Class AdminContextService
 * @package Core\Services
 */
class AdminContextService
{
    /** @var DependencyInjector $serviceContainer */
    protected $serviceContainer;

    /**
     * AdminContextService constructor.
     */
    function __construct()
    {
        $this->serviceContainer = DependencyInjector::getInstance();
    }

    /**
     * @return mixed
     */
    public function getModules()
    {
        return $this->serviceContainer->getService('modules')->getListModules(false);
    }

}