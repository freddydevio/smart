<?php

namespace App\Models;

use Core\ModelManager;
use Core\MongoDB;

class Plugin extends ModelManager
{
    /** @var string $table */
    protected static $table = 'plugins';

    private static function getConnection()
    {
        return new MongoDB(self::$table);
    }

    public static function create($document)
    {
        self::getConnection()->insert($document);
    }

    public static function remove($id)
    {
        self::getConnection()->remove($id);
    }

    public static function get($id)
    {
        return self::getConnection()->find($id);
    }

    public static function all()
    {
        $list = self::getConnection()->findAll();
        $result = [];
        foreach ($list as $key => $document) {
            $document = (array)$document;
            $document['_id'] = (string) new \MongoDB\BSON\ObjectId($document['_id']);
            $result[$key] = $document;
        }

        return $result;
    }

}