<?php

function read($table, $fields = '*')
{
    global $query;

    $query = [];

    $query['table'] = $table;

    $query['read'] = true;
    $query['execute'] = [];

    $query['sql'] = "Select {$fields} from {$table}";
}