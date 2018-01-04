<?php

namespace Core\Controllers;

class ModuleController extends Controller
{
    public function index()
    {
        var_dump("index");
    }

    public function list()
    {
        var_dump("list");
    }

    public function get($id)
    {
        var_dump("get" . $id);
    }
}