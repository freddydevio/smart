<?php

namespace Core\Controllers;

use App\Modules\Clock\Services\ClockDataService;
use App\Modules\Weather\Services\WeatherDataService;
use Core\Services\ConfigService;
use Core\Services\ContextService;
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
        /** @var ContextService $contextService */
        $contextService = $this->container->getService('ContextService');
        $dashboardContext = $contextService->getDashboardContext();

        $this->addViewVariables('dashboardContext', $dashboardContext);
        $this->addViewVariables('gridItems', $gridItems);
        $this->addViewVariables('moduleIntents', $this->getModuleIntents());

        View::renderTemplate('Dashboard/index.twig', $this->viewVariables);
    }

    private function getModuleIntents()
    {
        /** @var IntentsCollectorService $intentsCollector */
        $intentsCollector = $this->container->getService('IntentsCollectorService');
        return $intentsCollector->getModulesIntents();
    }


}