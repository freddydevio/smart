<?php

namespace App\Controllers;

use App\Models\Plugin;
use Core\Controller;

class Plugins extends Controller
{
    public function createAction()
    {
        $plugin = [
            'name' => 'Kalender',
            'author' => 'Frederik Dengler',
            'version' => '1.0.0'
        ];

        Plugin::create($plugin);
    }

    public function list()
    {
        $list = Plugin::all();

        print_r($list);
    }

    public function getAction($id)
    {
        $plugin = Plugin::get($id);

        print_r($plugin);
    }
}