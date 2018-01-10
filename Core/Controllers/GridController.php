<?php

namespace Core\Controllers;

use Core\Services\ContextService;
use Core\Services\GridService;
use Core\View\View;

class GridController extends Controller
{
    /** @var GridService $gridService */
    protected $gridService;

    protected function preDispatch()
    {
        parent::preDispatch();
        $this->gridService = $this->container->getService('GridService');
    }

    public function index()
    {
        /** @var ContextService $adminContext */
        $contextService = $this->container->getService('ContextService');
        $adminContext = $contextService->getAdminContext();

        $gridItems = $this->gridService->getGridItems();

        $widgetBasePaths = [
            'weather' => 'Weather/widget.twig'
        ];

        $this->addViewVariables('adminContext', $adminContext);
        $this->addViewVariables('gridItems', $gridItems);
        $this->addViewVariables('widgetBasePaths', $widgetBasePaths);


        View::renderTemplate('Admin/grid-settings.twig', $this->viewVariables);
    }

    public function create()
    {
        $this->gridService->createBasicGrid();
    }

    public function save()
    {
        var_dump("GridControlller::SAVE");
        //$this->gridService->saveGridPosition(null, null, null);
    }
}