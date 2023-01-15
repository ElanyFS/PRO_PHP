<?php

// function routes(){
//     return [
//         '/' => 'Home@index',
//         '/user/create' => 'User@create'
//     ];
// }
return [
    '/' => 'Home@index',
    '/user/create' => 'User@create',
    '/users/[0-9]+' => 'User@show',
    '/user/[0-9]+/name/[a-zA-Z]+' => 'User@showName'
];