<?php

namespace app\controllers;
class Maintenance{
    public function index($params){
        
        return[
            'view' => 'maintenance',
            'data' => ['title' => 'Em manutenção']
        ];
    }
}