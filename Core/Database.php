<?php

namespace Core;

interface Database
{
    public function getConnection();

    public function insert($data);

    public function find($id);

    public function findAll();

    public function remove($id);

}