<?php

namespace App\Controllers;

use Core\Controller;
use Core\View;

class SmartMirror extends Controller
{
    public function index()
    {
        $viewVariables = [
            'context' => $this->context,
            'controller' => 'SmartMirror',
            'action' => 'index'
        ];

        View::renderTemplate('SmartMirror/index.twig', $viewVariables);
    }
}