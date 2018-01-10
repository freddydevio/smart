<?php

namespace Core\Controllers;

use Core\Services\ConfigService;
use Core\Services\ContextService;
use Core\View\View;

class AdminController extends Controller
{
    /** @var ConfigService $configService */
    protected $configService;

    protected function preDispatch()
    {
        parent::preDispatch();
        /** @var ContextService $contextService */
        $contextService = $this->container->getService('ContextService');
        $adminContext = $contextService->getAdminContext();
        $this->configService = $this->container->getService('ConfigService');

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

    public function saveSettings()
    {
        $params = $_REQUEST;
        $params = array_slice($params, 1);

        unset($params['form']);

        foreach ($params as $key => $param) {
            $this->configService->saveConfig($key, $param);
        }

        $this->redirect('/admin/settings');
    }
}