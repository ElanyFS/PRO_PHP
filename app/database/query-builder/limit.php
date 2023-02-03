<?php

function limit($limit)
{
    global $query;

    if (isset($query['page'])) {
        throw new Exception('O limit não pode ser chamado com o pagination.');
    }

    $query['limit'] = true;
    $query['sql'] = "{$query['sql']} limit {$limit}";
}