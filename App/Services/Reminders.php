<?php

namespace App\Services;

use Core\Service;

class Reminders extends Service
{
    public function getReminders()
    {
        $reminders = [
                [
                    'label' => 'Opa Geburtstag',
                    'done' => true,
                ], [
                    'label' => 'FDDB einrichten',
                    'done' => false
                ]
        ];

        return $reminders;
    }
}