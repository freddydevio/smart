<?php

namespace Core\Controllers;

use Core\View\View;

class AdminController extends Controller
{
    protected function preDispatch()
    {
        parent::preDispatch();

        $adminContext = $this->container->getService('AdminContextService');

        $this->addViewVariables('adminContext', $adminContext);
    }

    public function index()
    {
        View::renderTemplate('Admin/index.twig', $this->viewVariables);
    }

    public function settings()
    {
        View::renderTemplate('Admin/dashboard-settings.twig', $this->viewVariables);
    }

    public function saveSetting()
    {

    }
}