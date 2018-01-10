<?php

namespace Core\Models\Context;

/**
 * Class AdminContext
 * @package Core\Models
 */
class AdminContext
{
    /** @var array $modules */
    private $modules;
    /** @var bool $autoReload */
    private $autoReload;
    /** @var int $autoReloadInterval */
    private $autoReloadInterval;
    /** @var bool $errorMessages */
    private $errorMessages;

    /**
     * @return array
     */
    public function getModules(): array
    {
        return $this->modules;
    }

    /**
     * @param array $modules
     */
    public function setModules(array $modules)
    {
        $this->modules = $modules;
    }

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
     * @return bool
     */
    public function isErrorMessages(): bool
    {
        return $this->errorMessages;
    }

    /**
     * @param bool $errorMessages
     */
    public function setErrorMessages(bool $errorMessages)
    {
        $this->errorMessages = $errorMessages;
    }
}