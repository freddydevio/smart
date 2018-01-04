<?php

namespace App\Services;

use App\Models\FitnessManager\ProfileRepository;
use Core\Service;

class FitnessManager implements Service
{

    public function saveProfile()
    {

    }

    public function getProfile()
    {
        $profileRepository = new ProfileRepository();
        $profiles = $profileRepository::getAll();
    }

}