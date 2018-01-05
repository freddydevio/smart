<?php

namespace Core\Controllers;

use Core\DependencyInjector;

abstract class Controller
{
    /** @var DependencyInjector $container */
    protected $container;
    /** @var array $viewVariables */
    protected $viewVariables = [];

    function __construct()
    {
        $this->container = DependencyInjector::getInstance();
    }

    public function __call($method, $args)
    {
        if (method_exists($this, $method)) {
            if ($this->preDispatch() !== false) {
                call_user_func_array([$this, $method], $args);
                $this->postDispatch();
            }
        } else {
            throw new \Exception("Method $method not found in controller " . get_class($this));
        }
    }

    protected function preDispatch(){}

    protected function postDispatch(){}

    protected function json($output)
    {
        echo json_encode($output);
    }

    protected function redirect($url)
    {
        header('Location: ' . $url);
        exit();
    }

}