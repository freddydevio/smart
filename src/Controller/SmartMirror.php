<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SmartMirror extends Controller
{
    /**
     * @Route("/smartmirror/index")
     */
    public function index()
    {
        return $this->render('smartmirror/index.html.twig');
    }
}