<?php

namespace App\Models\FitnessManager;

use Core\Repository;

class ProfileRepository extends Repository
{

    public static function get($query)
    {

    }

    public static function getAll()
    {
        $db = static::getDB();
        return $db->query('SELECT * FROM fitness_manager_profiles');
    }

    public static function remove($query)
    {

    }

    public static function update($query)
    {

    }
}