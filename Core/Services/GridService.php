<?php

namespace Core\Services;

use App\Modules\Clock\Services\ClockDataService;
use App\Modules\News\Services\NewsDataService;
use App\Modules\Weather\Services\WeatherDataService;
use Core\Database\Connection;
use Core\DependencyInjector;

class GridService
{
    /** @var DependencyInjector $serviceContainer */
    protected $serviceContainer;

    function __construct()
    {
        $this->serviceContainer = DependencyInjector::getInstance();
    }

    public function getGridItems()
    {
        /** @var Connection $db */
        $db = $this->serviceContainer->getService('database');
        $conn = $db->getDb();
        $stmt = $conn->query('SELECT * FROM smart.grid');

        $gridItems = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $gridItems = $this->sortGridItems($gridItems);

        foreach ($gridItems as &$gridItem) {
            $gridItem['data'] = $this->getWidgetDataByModuleId($gridItem['moduleId']);
        }

        return $gridItems;
    }

    private function getWidgetDataByModuleId($moduleId)
    {
        $data = null;

        if($moduleId == 1) {
            /** @var WeatherDataService $weatherService */
            $weatherService = $this->serviceContainer->getService('WeatherDataService');
            $data = $weatherService->getWeatherData();
        }elseif($moduleId == 2) {
            /** @var ClockDataService $clockService */
            $clockService = $this->serviceContainer->getService('ClockDataService');
            $data = $clockService->getData();
        }elseif($moduleId == 3) {
            /** @var NewsDataService $newsDataService */
            $newsDataService = $this->serviceContainer->getService('NewsDataService');
            $data = $newsDataService->getData();
        }

        return $data;
    }

    private function sortGridItems($gridItems)
    {
        usort($gridItems, function ($item1, $item2) {
            return $item1['position'] <=> $item2['position'];
        });

        return $gridItems;

    }

    public function saveGridPosition($id, $moduleId, $position)
    {

    }

    public function createBasicGrid()
    {
        /** @var Connection $db */
        $db = $this->serviceContainer->getService('database');
        $conn = $db->getDb();
        $conn->query('INSERT INTO smart.grid (moduleId, position, size) VALUES (1, 100, 1)')->execute();
    }
}