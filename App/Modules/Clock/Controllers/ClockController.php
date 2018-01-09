<?php

namespace App\Modules\Clock\Controllers;

use App\Modules\Clock\Services\ClockDataService;
use Core\Controllers\Controller;

class ClockController extends Controller
{
    public function getData()
    {
        /** @var ClockDataService $clockDataService */
        $clockDataService = $this->container->getService('ClockDataService');
        $this->json($clockDataService->getData());
    }
}