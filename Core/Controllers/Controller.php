<?php

namespace Core\Controllers;

use Core\DependencyInjector;

abstract class Controller
{
    /** @var DependencyInjector $container */
    protected $container;

    function __construct()
    {
        $this->container = DependencyInjector::getInstance();
    }

    public function __call($method, $args)
    {
        if (method_exists($this, $method)) {
            if ($this->before() !== false) {
                call_user_func_array([$this, $method], $args);
                $this->after();
            }
        } else {
            throw new \Exception("Method $method not found in controller " . get_class($this));
        }
    }

    protected function before(){}

    protected function after(){}

}