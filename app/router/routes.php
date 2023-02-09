<?php
return [
    "POST" => [
        '/login' => 'Login@store',
        '/contact' => 'Contact@store',
        '/user/create' => 'User@createStore',
        '/user/image/edit' => 'Users@store'
    ],

    "GET" => [
        '/' => 'Home@index',
        '/users' => 'Users@index',
        '/user/userlog' => 'User@dadosUsuario',
        '/contact' =>'Contact@index',
        '/login' => "Login@index",
        '/logout' => 'Login@destroy',
        '/edit' => 'User@edit',
        '/user/create' => 'User@createIndex',
        '/user/[0-9]+' => 'User@userID'
    ]
];
