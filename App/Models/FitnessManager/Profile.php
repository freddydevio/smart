<?php

namespace App\Models\FitnessManager;

use Core\Repository;

class Profile extends Repository
{
    /** @var integer $id */
    private $id;
    /** @var double $targetWeight */
    private $targetWeight;
    /** @var double $currentWeight */
    private $currentWeight;
    /** @var array $weightTable */
    private $weightTable;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTargetWeight()
    {
        return $this->targetWeight;
    }

    /**
     * @param mixed $targetWeight
     */
    public function setTargetWeight($targetWeight)
    {
        $this->targetWeight = $targetWeight;
    }

    /**
     * @return mixed
     */
    public function getCurrentWeight()
    {
        return $this->currentWeight;
    }

    /**
     * @param mixed $currentWeight
     */
    public function setCurrentWeight($currentWeight)
    {
        $this->currentWeight = $currentWeight;
    }

    /**
     * @return mixed
     */
    public function getWeightTable()
    {
        return $this->weightTable;
    }

    /**
     * @param mixed $weightTable
     */
    public function setWeightTable($weightTable)
    {
        $this->weightTable = $weightTable;
    }

}