<?php

namespace Core\Controllers;

use Core\View\View;

class AdminController extends Controller
{
    public function index()
    {
        $adminContext = $this->container->getService('adminContext');
        var_dump($adminContext->getModules(false));
        die();
        $customVariables = [
            'modules' => $adminContext->getModules(false)
        ];

        $this->viewVariables = array_merge($this->viewVariables, $customVariables);

        View::renderTemplate('Admin/index.twig', $this->viewVariables);
    }
}