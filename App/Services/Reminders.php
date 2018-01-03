<?php

namespace App\Services;

use Core\Service;

class Reminders implements Service
{
    public function getReminders()
    {
        $reminders = [
                [
                    'label' => 'Prepare github pages',
                    'done' => true,
                ], [
                    'label' => 'Create more widgets and ability to extend widgets and services',
                    'done' => false
                ]
        ];

        return $reminders;
    }
}