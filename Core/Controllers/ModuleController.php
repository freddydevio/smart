<?php

namespace Core\Controllers;

use Core\Modules\Modules;

class ModuleController extends Controller
{
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
        var_dump("get" . $id);
    }
}