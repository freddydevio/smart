<?php

namespace Core;

use App\Config;

class MongoDB implements Database
{
    /** @var string $database */
    protected $database;
    /** @var string $table */
    private $table;
    /** @var \MongoCollection $collection */
    private $collection = null;

    function __construct($tableName)
    {
        $this->table = $tableName;
        $this->readConfig();
        $this->getConnection();
    }

    private function readConfig()
    {
        $this->database = Config::MONGO_DATABASE;
    }

    public function getConnection()
    {
        $db = $this->database;
        $table = $this->table;
        $this->collection = (new \MongoDB\Client)->$db->$table;
    }

    public function findAll()
    {
        return $this->collection->find();
    }

    public function find($id)
    {
        return $this->collection->findOne($id);
    }

    public function insert($document)
    {
        $this->collection->insertOne($document);
    }

    public function remove($id)
    {
        $this->collection->remove($id);
    }
}