<?php

namespace Core\Controllers;

use Core\View\View;

class DashboardController extends Controller
{
    public function index()
    {
        var_dump('DashboardController::index');
        View::renderTemplate('Dashboard/index.twig');
    }
}