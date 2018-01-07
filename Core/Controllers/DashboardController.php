<?php

namespace Core\Controllers;

use App\Modules\Weather\Services\WeatherDataService;
use Core\Services\GridService;
use Core\View\View;

class DashboardController extends Controller
{
    public function index()
    {
        /** @var GridService $gridService */
        $gridService = $this->container->getService('GridService');
        $gridItems = $gridService->getGridItems();

        foreach ($gridItems as &$gridItem) {
            $gridItem['data'] = $this->getWidgetDataByModuleId($gridItem['moduleId']);
        }

//        var_dump($gridItems);
//        die();

        $this->addViewVariables('gridItems', $gridItems);

        View::renderTemplate('Dashboard/index.twig', $this->viewVariables);
    }

    private function getWidgetDataByModuleId($moduleId)
    {
        $data = null;

        if($moduleId == 1) {
            /** @var WeatherDataService $weatherService */
            $weatherService = $this->container->getService('WeatherDataService');
            $data = $weatherService->getWeatherData();

        }

        return $data;
    }
}