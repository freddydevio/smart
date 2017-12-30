<?php

namespace App\Controllers;

use Core\Controller;
use Core\View;

class Index extends Controller
{
    public function indexAction()
    {
        $viewVariables = [
            'context' => $this->context
        ];

        View::renderTemplate('Index/index.twig', $viewVariables);
    }

    public function testAction()
    {
        echo "test1";
    }
}