<?php

namespace Core\Controllers;

use Core\Services\LessCompilerService;

class LessCompilerController extends Controller
{

    public function index()
    {
        /** @var LessCompilerService $lessCompilerService */
        $lessCompilerService = $this->container->getService('LessCompilerService');
        $lessCompilerService->compileLessFiles();
    }
}