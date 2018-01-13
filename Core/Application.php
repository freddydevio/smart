<?php

namespace Core;

use Core\Routing\Dispatcher;
use Core\Routing\Request;

class Application
{

    /** @var DependencyInjector dependencyInjector */
    protected $dependencyInjector;
    /** @var Bootstrap $bootstrap */
    protected $bootstrap;

    function __construct()
    {
        $this->dependencyInjector = DependencyInjector::getInstance();
        $this->bootstrap = new Bootstrap($this->dependencyInjector);
    }

    public function run()
    {
        /** @var Dispatcher $dispatcher */
        $dispatcher = $this->dependencyInjector->getService('dispatcher');
        $dispatcher->dispatch($_SERVER['QUERY_STRING']);
    }
}