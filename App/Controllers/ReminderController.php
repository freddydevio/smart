<?php

namespace App\Controllers;

use App\Services\Reminders;
use Core\Controller;
use Core\ServiceManager;

class ReminderController extends Controller
{
    /** @var Reminders $service */
    private $service;

    protected function before()
    {
        parent::before();

        $service = new ServiceManager();
        $this->service = $service->getService('Reminders');
    }

    public function indexAction()
    {
        $reminders = $this->service->getReminders();

        echo json_encode($reminders);
    }
}