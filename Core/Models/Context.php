<?php

namespace Core\Models;

use Core\ModelManager;

class Context extends ModelManager
{
    /** @var string $baseUrl */
    private $baseUrl;
    /** @var string $assetsUrl*/
    private $assetsUrl;

    /**
     * @return string
     */
    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    /**
     * @param string $baseUrl
     */
    public function setBaseUrl(string $baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    /**
     * @return string
     */
    public function getAssetsUrl(): string
    {
        return $this->assetsUrl;
    }

    /**
     * @param string $assetsUrl
     */
    public function setAssetsUrl(string $assetsUrl)
    {
        $this->assetsUrl = $assetsUrl;
    }

}