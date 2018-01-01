<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SmartMirror
{
    /**
     * @Route("/smartmirror/index")
     */
    public function indexAction()
    {
        return new Response('hallo');
    }
}