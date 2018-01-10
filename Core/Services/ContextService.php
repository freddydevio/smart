<?php

namespace Core\Services;

use Core\Models\Context\AdminContext;
use Core\Models\Context\DashboardContext;
use Core\Modules\Modules;

/**
 * Class AdminContextService
 * @package Core\Services
 */
class ContextService extends Service
{
    /** @var AdminContext $adminContext */
    private $adminContext;
    /** @var DashboardContext $dashboardContext */
    private $dashboardContext;

    /**
     * @return AdminContext
     */
    public function getAdminContext()
    {
        if(is_null($this->adminContext)){
            $this->createAdminContext();
        }

        return $this->adminContext;
    }

    public function createAdminContext()
    {
        /** @var Modules $modelService */
        $modelService = $this->serviceContainer->getService('modules');
        /** @var ConfigService $configService */
        $configService = $this->serviceContainer->getService('ConfigService');

        $context = new AdminContext();
        $context->setModules($modelService->getListModules(false));
        $context->setAutoReload($configService->getGeneralConfig('page_reload', true, 'bool'));
        $context->setAutoReloadInterval($configService->getGeneralConfig('page_reload_interval', 60));
        $context->setErrorMessages($configService->getGeneralConfig('show_error_messages', true));

        $this->adminContext = $context;
    }

    /**
     * @return DashboardContext
     */
    public function getDashboardContext()
    {
        if(is_null($this->dashboardContext)){
            $this->createDashboardContext();
        }

        return $this->dashboardContext;
    }

    public function createDashboardContext()
    {
        /** @var ConfigService $configService */
        $configService = $this->serviceContainer->getService('ConfigService');

        $context = new DashboardContext();
        $context->setAutoReload($configService->getGeneralConfig('page_reload', true));
        $context->setAutoReloadInterval($configService->getGeneralConfig('page_reload_interval', 30));
        $context->setModuleWidgetPaths([
            '1' => 'Weather/widget.twig',
            '2' => 'Clock/widget.twig',
            '3' => 'News/widget.twig'
        ]);

        $this->dashboardContext = $context;
    }
}