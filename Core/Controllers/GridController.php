<?php

namespace Core\Controllers;

use Core\Services\AdminContextService;
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
        /** @var AdminContextService $adminContext */
        $adminContext = $this->container->getService('AdminContextService');
        $gridItems = $this->gridService->getGridItems();

        $widgetBasePaths = [
            'weather' => 'Weather/widget.twig'
        ];

        $viewVariables = [
            'adminContext' => $adminContext,
            'gridItems' => $gridItems,
            'widgetBasePaths' => $widgetBasePaths
        ];

        $this->viewVariables = array_merge($this->viewVariables, $viewVariables);

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