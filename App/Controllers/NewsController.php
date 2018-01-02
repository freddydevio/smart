<?php

namespace App\Controllers;

use App\Services\News;
use Core\Controller;
use Core\ServiceManager;

class NewsController extends Controller
{
    const DEFAULT_LIST_MAX = 5;
    /** @var News $service */
    private $service;

    protected function before()
    {
        parent::before();

        $service = new ServiceManager();
        $this->service = $service->getService('News');
    }

    public function indexAction()
    {
        return $this->service->getNews(5);
    }
}