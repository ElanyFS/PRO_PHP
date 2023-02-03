<?php

// function where($field, $operator, $value)
// {
//     global $query;

//     if(!isset($query['read'])){
//         throw new Exception('Necessário chamar o read antes do where.');
//     }

//     if(func_num_args() !== 3){
//         throw new Exception('Where precisa de exatamente 3 parâmetros.  ');
//     }

//     $query['where'] = true;

//     $query['execute'] = array_merge($query['execute'],[$field => $value]);

//     $query['sql'] = "{$query['sql']} where {$field} {$operator} :{$field}";
// }

function where()
{
    global $query;

    $args = func_get_args();
    $numArgs = func_num_args();

    if (!isset($query['read'])) {
        throw new Exception('Necessário chamar o read antes do where.');
    }

    if (func_num_args() !== 3) {
        throw new Exception('Where precisa de exatamente 3 parâmetros.  ');
    }

    if ($numArgs == 2) {
        $field = $args[0];
        $operator = '=';
        $value = $args[1];
    }

    if ($numArgs == 3) {
        $field = $args[0];
        $operator = $args[1];
        $value = $args[2];
    }

    $query['where'] = true;

    $query['execute'] = array_merge($query['execute'], [$field => $value]);

    $query['sql'] = "{$query['sql']} where {$field} {$operator} :{$field}";
}

// function orAndWhere($field, $operator, $value, $typeWhere = 'or')
// {
//     global $query;

//     if(!isset($query['read'])){
//         throw new Exception('Necessário chamar o read antes do where.');
//     }

//     if(!isset($query['where'])){
//         throw new Exception('Necessário chamar o where antes do orAndWhere.');
//     }

//     if(func_num_args() < 3){
//         throw new Exception('Where precisa de exatamente 3 ou 4 parâmetros.  ');
//     }

//     $query['orAndWhere'] = true;

//     $query['execute'] = array_merge($query['execute'],[$field => $value]);

//     $query['sql'] = "{$query['sql']} {$typeWhere} {$field} {$operator} :{$field}";
// }

function orAndWhere($field, $operator, $value, $typeWhere = 'or')
{
    global $query;

    $args = func_get_args();
    $numArgs = func_num_args();

    if (!isset($query['read'])) {
        throw new Exception('Necessário chamar o read antes do where.');
    }

    if (!isset($query['where'])) {
        throw new Exception('Necessário chamar o where antes do orAndWhere.');
    }

    if (func_num_args() < 3) {
        throw new Exception('Where precisa de exatamente 3 ou 4 parâmetros.  ');
    }

    $data = match ($numArgs) {
        2 => whereTwoParameters($args),
        3 => whereThreeParameters($args),
        4 => $args,
    };

    [$field, $operator, $value, $typeWhere] = $data;

    $query['orAndWhere'] = true;

    $query['execute'] = array_merge($query['execute'], [$field => $value]);

    $query['sql'] = "{$query['sql']} {$typeWhere} {$field} {$operator} :{$field}";
}

function whereTwoParameters(array $args)
{
    $field = $args[0];
    $operator = '=';
    $value = $args[1];
    $typeWhere = 'or';

    return [$field, $operator, $value, $typeWhere];
}

function whereThreeParameters(array $args)
{
    $field = $args[0];
    $operators = ['=', '<', '>', '!=='];
    $operator = in_array($args[1], $operators) ? $args[1] : '=';
    $value = in_array($args[1], $operators) ? $args[2] : $args[1];
    $typeWhere = $args[2] === 'and' ? 'and' : 'or';

    return [$field, $operator, $value, $typeWhere];
}

// function whereFourParameters(array $args)
// {
//     $field = $args[0];
//     $operator = $args[1];
//     $value = $args[2];
//     $typeWhere = $args[3];

//     return [$field, $operator, $value, $typeWhere];
// }

function whereIn($field, array $args)
{
    global $query;

    if (isset($query['where'])) {
        throw new Exception('Where não pode ser chamado com o Where In');
    }

    $query['where'] = true;

    $query['sql'] = "{$query['sql']} where {$field} in (" . '\' ' . implode('\' , \'', $args) . '\'' . ")";
}