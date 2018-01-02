<?php

namespace App\Controllers;

use Core\Controller;
use Core\ServiceManager;
use Core\View;

class SmartMirrorController extends Controller
{
    public function before()
    {
        parent::before();
        $serviceManager = new ServiceManager();

        $reminderService = $serviceManager->getService('Reminders');
        $reminderList = $reminderService->getReminders();

        $newsService = $serviceManager->getService('News');
        $newsList = $newsService->getNews(5);

        $this->viewParams['widgets'] = [
            [
                'type' => 'weather',
                'options' => [
                    'size' => 'small'
                ]
            ], [
                'type' => 'calender',
                'options' => [
                    'size' => 'small'
                ]
            ], [
                'type' => 'news',
                'data' => $newsList,
                'options' => [
                    'size' => 'large'
                ]
            ], [
                'type' => 'reminders',
                'data' => $reminderList,
                'options' => [
                    'size' => 'large'
                ]
            ], [
                'type' => 'brand',
                'options' => [
                    'size' => 'large'
                ]
            ]
        ];
    }

    public function indexAction()
    {
        View::renderTemplate('smart-mirror/index.twig', $this->viewParams);
    }
}