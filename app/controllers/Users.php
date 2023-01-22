<?php

namespace app\controllers;

class Users
{
    public function index()
    {
        // echo json_encode($_SERVER);
        $users = all('usuarios', 'idusuarios,nome_user');

        echo json_encode($users);
    }
}
