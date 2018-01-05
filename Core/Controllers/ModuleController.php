<?php

namespace Core\Controllers;

use Core\Modules\Modules;
use Core\Services\AdminContext;
use Core\View\View;

class ModuleController extends Controller
{
    /** @var AdminContext $adminContext */
    protected $adminContext;

    protected function preDispatch()
    {
        parent::preDispatch();
        $this->adminContext = $this->container->getService('adminContext');
    }

    public function index()
    {
        var_dump("index");
    }

    public function list()
    {
        /** @var Modules $moduleService */
        $moduleService = $this->container->getService('modules');
        $this->json($moduleService->getListModules(false));
    }

    public function install()
    {
        var_dump("install");
        /** @var Modules $moduleService */
        $moduleService = $this->container->getService('modules');
        //upload
        $file = APPLICATION_ROOT . '/App/Modules/Spotify.zip';
        //unpack
        $moduleService->install($file);
        //register sth
    }

    public function get($id)
    {
        /** @var Modules $moduleService */
        $moduleService = $this->container->getService('modules');
        $module = $moduleService->getModule($id);

        $viewVariables = [
            'module' => $module
        ];
        $this->viewVariables = array_merge($this->viewVariables, $viewVariables);

        View::renderTemplate('Admin/module-settings.twig', $this->viewVariables);
    }

    public function settings($id)
    {
        /** @var Modules $moduleService */
        $moduleService = $this->container->getService('modules');
        $module = $moduleService->getModule($id);

        $viewVariables = [
            'module' => $module,
            'adminContext' => $this->adminContext
        ];
        $this->viewVariables = array_merge($this->viewVariables, $viewVariables);

        View::renderTemplate('Admin/module-settings.twig', $this->viewVariables);
    }
}