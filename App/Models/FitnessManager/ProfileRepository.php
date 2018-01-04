<?php

namespace App\Models\FitnessManager;

use Core\Repository;

class ProfileRepository extends Repository
{
    protected $table = 'fitness_manager_profiles';

    public static function get($query)
    {

    }

    public static function getAll()
    {
        $db = static::getDB();
        return $db->query('SELECT * FROM fitness_manager_profiles')->fetchAll();
    }

    public static function create($object)
    {
        $db = static::getDB();
    }

    public static function remove($query)
    {

    }

    public static function update($query)
    {

    }
}