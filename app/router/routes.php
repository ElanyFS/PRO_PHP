<?php
return [
    "POST" => [
        '/login' => 'Login@store',
        '/user/create' => 'User@createStore'
    ],

    "GET" => [
        '/' => 'Home@index',
        '/login' => "Login@index",
        '/logout' => 'Login@destroy',
        '/user/create' => 'User@createIndex',
        '/user/[0-9]+' => 'User@userID'
    ]
];
