<?php

namespace App\Modules\News\Controllers;

use App\Modules\News\Services\NewsDataService;
use Core\Controllers\Controller;

class NewsController extends Controller
{
    public function getData()
    {
        /** @var NewsDataService $newsDataService */
        $newsDataService = $this->container->getService('NewsDataService');

        $this->json($newsDataService->getData(5));
    }
}