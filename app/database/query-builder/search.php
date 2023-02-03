<?php

function search(array $search)
{
    global $query;

    if (isset($query['where'])) {
        throw new Exception('Where não pode ser chamado junto com a busca.');
    }

    if (!arrayAssociative($search)) {
        throw new Exception('Necessário ser um array associativo.');
    }

    $sql = "{$query['sql']} where ";

    $execute = [];

    foreach ($search as $field => $searched) {
        $sql .= "{$field} like :{$field} or ";
        $execute[$field] = "%{$searched}%";
    }

    $sql = rtrim($sql, ' or ');

    // var_dump($sql);

    $query['sql'] = $sql;
    $query['execute'] = $execute;
}