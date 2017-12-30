<?php

namespace Core;

use Core\Models\Context;

class ContextFactory
{
    private $context = null;

    public function getContext() : array
    {
        if(is_null($this->context)) {
            $this->createContext();
        }

        return $this->context;
    }

    private function createContext()
    {
        $context = new Context();
        $context->setAssetsUrl(ASSETS_DIRECTORY);
        $context->setBaseUrl(BASE_URL);

        $this->context = $context->toArray($context);
    }
}