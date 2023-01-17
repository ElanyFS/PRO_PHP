<?php
return [
    'POST' => [
        '/login' => 'User@login'
    ],

    'GET' => [
        '/' => 'Home@index',
        '/login' => "Login@index",
        '/user/create' => 'User@create',
        '/user/[0-9]+' => 'User@userID'
    ]
];
