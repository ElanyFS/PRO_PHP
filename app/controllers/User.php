<?php

namespace app\controllers;

class User
{

    public function show()
    {
        return[
            'view' => 'user.php',
            'data' => ['title' => 'User']
        ];
    }
}
