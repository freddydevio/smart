<?php

namespace Core\Services;

use Core\DependencyInjector;

/**
 * Class Service
 * @package Core\Services
 */
abstract class Service
{
    /** @var  DependencyInjector $serviceContainer */
    protected $serviceContainer;

    /**
     * Service constructor.
     */
    function __construct()
    {
        $this->serviceContainer = DependencyInjector::getInstance();
    }
}