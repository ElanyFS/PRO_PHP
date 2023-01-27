<?php
function arrayAssociative($arr)
{
    return array_keys($arr) !== range(0, count($arr) - 1);
}


function isAjax()
{
    return isset($_SERVER['HTTP_HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
}

function ddd($data)
{
    if ($_ENV['PRODUCTION'] === 'true') {
        var_dump('Something get wrong');
        die();
    }

    var_dump($data);
}
