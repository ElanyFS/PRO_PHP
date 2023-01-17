<?php

namespace app\controllers;

class Login
{
    public function index()
    {
        // var_dump('Login');
        // die();

        return[
            'view' => 'login.php',
            'data' => ['title' => 'Login']
        ];
    }
}
