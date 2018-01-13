<?php

namespace Core\Routing;

class Request
{
    /** @var \HttpRequest $request */
    protected $request;
    /** @var array $server */
    protected $server;
    /** @var array $postVar */
    protected $postVar;
    /** @var array $getVar */
    protected $getVar;

    function __construct()
    {
        $this->request = $_REQUEST;
        $this->server = $_SERVER;
        $this->postVar = $_POST;
        $this->getVar = $_GET;
    }

    public function isGet()
    {
        return ($this->server['REQUEST_METHOD'] == 'GET' ? true : false);
    }

    public function isPost()
    {
        return ($this->server['REQUEST_METHOD'] == 'POST' ? true : false);
    }

    public function getParam($key, $default = null)
    {
        if ($this->isPost()) {
            if (isset($this->postVar[$key])) {
                return $this->postVar[$key];
            }
        } else if ($this->isGet()) {
            if (isset($this->getVar[$key])) {
                return $this->getVar[$key];
            }
        }

        return $default;
    }

    public function getAllParams()
    {
        if ($this->isPost()) {
            return $this->postVar;
        } else if ($this->isGet()) {
            return $this->getVar;
        }
    }
}