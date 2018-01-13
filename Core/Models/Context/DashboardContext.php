<?php

namespace Core\Models\Context;

/**
 * Class DashboardContext
 * @package Core\Models\Context
 */
class DashboardContext
{
    /** @var bool $autoReload */
    private $autoReload;
    /** @var int $autoReloadInterval */
    private $autoReloadInterval;
    /** @var array $moduleWidgetPaths */
    private $moduleWidgetPaths;
    /** @var int $windowOffset */
    private $windowOffset;
    /** @var int $maxWindowWidth */
    private $maxWindowWidth;

    /**
     * @return bool
     */
    public function isAutoReload(): bool
    {
        return $this->autoReload;
    }

    /**
     * @param bool $autoReload
     */
    public function setAutoReload(bool $autoReload)
    {
        $this->autoReload = $autoReload;
    }

    /**
     * @return int
     */
    public function getAutoReloadInterval(): int
    {
        return $this->autoReloadInterval;
    }

    /**
     * @param int $autoReloadInterval
     */
    public function setAutoReloadInterval(int $autoReloadInterval)
    {
        $this->autoReloadInterval = $autoReloadInterval;
    }

    /**
     * @return array
     */
    public function getModuleWidgetPaths(): array
    {
        return $this->moduleWidgetPaths;
    }

    /**
     * @param array $moduleWidgetPaths
     */
    public function setModuleWidgetPaths(array $moduleWidgetPaths)
    {
        $this->moduleWidgetPaths = $moduleWidgetPaths;
    }

    /**
     * @return int
     */
    public function getWindowOffset(): int
    {
        return $this->windowOffset;
    }

    /**
     * @param int $windowOffset
     */
    public function setWindowOffset(int $windowOffset)
    {
        $this->windowOffset = $windowOffset;
    }

    /**
     * @return int
     */
    public function getMaxWindowWidth(): int
    {
        return $this->maxWindowWidth;
    }

    /**
     * @param int $maxWindowWidth
     */
    public function setMaxWindowWidth(int $maxWindowWidth)
    {
        $this->maxWindowWidth = $maxWindowWidth;
    }

}