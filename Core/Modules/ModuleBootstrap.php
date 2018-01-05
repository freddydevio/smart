<?php

namespace Core\Modules;

/**
 * Interface ModuleBootstrap
 * @package Core\Modules
 */
interface ModuleBootstrap
{
    /**
     * @return string
     */
    public function getModuleName();

    /**
     * @return array
     */
    public function getRoutes();
}