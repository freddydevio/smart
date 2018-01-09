<?php

namespace Core\Controllers;

use App\Modules\Clock\Services\ClockDataService;
use App\Modules\Weather\Services\WeatherDataService;
use Core\Services\ConfigService;
use Core\Services\GridService;
use Core\Services\IntentsCollectorService;
use Core\View\View;

class DashboardController extends Controller
{
    /** @var ConfigService $configService */
    protected $configService;
    /** @var GridService $gridService */
    protected $gridService;

    protected function preDispatch()
    {
        parent::preDispatch();

        $this->gridService = $this->container->getService('GridService');
        $this->configService = $this->container->getService('ConfigService');
    }

    public function index()
    {
        $gridItems = $this->gridService->getGridItems();

        foreach ($gridItems as &$gridItem) {
            $gridItem['data'] = $this->getWidgetDataByModuleId($gridItem['moduleId']);
            $gridItem['dataUrl'] = 'test';
        }

        $moduleWidgetPaths = [
            '1' => 'Weather/widget.twig',
            '2' => 'Clock/widget.twig'
        ];

        $pageLoaderActive = $this->configService->getGeneralConfig('page_loader', false);

        $this->addViewVariables('widgetPaths', $moduleWidgetPaths);
        $this->addViewVariables('gridItems', $gridItems);
        $this->addViewVariables('moduleIntents', $this->getModuleIntents());
        $this->addViewVariables('pageLoaderActive', $pageLoaderActive);

        View::renderTemplate('Dashboard/index.twig', $this->viewVariables);
    }

    private function getModuleIntents()
    {
        /** @var IntentsCollectorService $intentsCollector */
        $intentsCollector = $this->container->getService('IntentsCollectorService');
        return $intentsCollector->getModulesIntents();
    }

    private function getWidgetDataByModuleId($moduleId)
    {
        $data = null;

        if($moduleId == 1) {
            /** @var WeatherDataService $weatherService */
            $weatherService = $this->container->getService('WeatherDataService');
            $data = $weatherService->getWeatherData();
        }elseif($moduleId == 2) {
            /** @var ClockDataService $clockService */
            $clockService = $this->container->getService('ClockDataService');
            $data = $clockService->getData();
        }

        return $data;
    }
}