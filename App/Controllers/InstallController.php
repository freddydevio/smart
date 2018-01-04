<?php

namespace App\Controllers;

use App\Services\Installer;
use Core\Controller;
use Core\View;

class InstallController extends Controller
{
    /** @var Installer $installerService */
    private $installerService;

    protected function before()
    {
        parent::before();
        $this->installerService = $this->serviceManager->getService(Installer::class);
    }

    public function indexAction()
    {
        $this->router->dispatch('install/settings');
    }

    public function settingsAction()
    {
        View::renderTemplate('installer/settings.twig', $this->viewParams);
        //$this->router->dispatch('install/finish');
    }

    public function finishAction()
    {
        echo "finsih";
    }
}