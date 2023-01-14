<?php

namespace app\controllers;
class Home{
    public function index($params){
        // var_dump($params);
        // die();
        return[
            'view' => 'home.php',
            'data' => ['name' => 'Elany']
        ];
    }
}