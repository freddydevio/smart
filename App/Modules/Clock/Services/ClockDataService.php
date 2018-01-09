<?php

namespace App\Modules\Clock\Services;

use Core\Services\ConfigService;
use Core\Services\Service;

class ClockDataService extends Service
{
    /** @var string $timezone */
    private $timezone;

    function __construct()
    {
        parent::__construct();

        /** @var ConfigService $configService */
        $configService = $this->serviceContainer->getService('ConfigService');
        $this->timezone = $configService->getModuleConfig('clock_timezone', 'Europe/Berlin');
    }

    public function getData()
    {
        $data['time'] = $this->getCurrentTime();
        $data['date'] = $this->getCurrentDate();

        return $data;
    }

    public function getCurrentTime()
    {

        $date = new \DateTime("now", new \DateTimeZone($this->timezone) );
        return $date->format('H:i:s');
    }

    public function getCurrentDate()
    {
        $date = new \DateTime("now", new \DateTimeZone($this->timezone) );
        return $date->format('D, M.Y');
    }
}