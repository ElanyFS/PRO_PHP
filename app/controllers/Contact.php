<?php

namespace app\controllers;

class Contact{
    public function index(){
        return [
            'view' => 'contact',
            'data' => ['title' => 'Contact']
        ];
    }
}