<?php

namespace Core\Routing;

class Router
{
    private $routeCollector;

    function __construct()
    {
        $this->routeCollector = new RouteCollector();
    }

    public function getRoutes()
    {
        return $this->routeCollector->getRoutes();
    }
}