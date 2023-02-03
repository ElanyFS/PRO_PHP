<?php

function order($by, $order = 'asc')
{
    global $query;

    if (isset($query['limit'])) {
        throw new Exception('Necessário chamar o order antes do limit.');
    }

    if (isset($query['page'])) {
        throw new Exception('O order não pode ser chamado depois do pagination.');
    }

    $query['order'] = true;

    $query['sql'] = "{$query['sql']} order by {$by} {$order}";
}