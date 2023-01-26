<?php

$query = [];

function read($table, $fields = '*')
{
    global $query;
    $query['read'] = true;
    $query['execute'] = [];

    $query['sql'] = "Select {$fields} from {$table}";
}

function where($field, $operator, $value)
{
    global $query;

    if(!isset($query['read'])){
        throw new Exception('Necessário chamar o read antes do where.');
    }

    if(func_num_args() !== 3){
        throw new Exception('Where precisa de exatamente 3 parâmetros.  ');
    }

    $query['where'] = true;

    $query['execute'] = array_merge($query['execute'],[$field => $value]);

    $query['sql'] = "{$query['sql']} where {$field} {$operator} :{$field}";
}

function orAndWhere($field, $operator, $value, $typeWhere = 'or')
{
    global $query;

    if(!isset($query['read'])){
        throw new Exception('Necessário chamar o read antes do where.');
    }

    if(!isset($query['where'])){
        throw new Exception('Necessário chamar o where antes do orAndWhere.');
    }

    if(func_num_args() < 3){
        throw new Exception('Where precisa de exatamente 3 ou 4 parâmetros.  ');
    }

    $query['orAndWhere'] = true;

    $query['execute'] = array_merge($query['execute'],[$field => $value]);

    $query['sql'] = "{$query['sql']} where {$typeWhere} {$field} {$operator} :{$field}";
}

function execute()
{
    global $query;

    $connect = connect();

    $prepare = $connect->prepare($query['sql']);
    $prepare->execute($query['execute'] ?? []);

    // var_dump($query);
    // var_dump($prepare);

    return $prepare->fetchAll();
}

// function all($table, $fields = '*')
// {
//     try {
//         $connect = connect();

//         $query = $connect->query("Select {$fields} from {$table}");
//         return $query->fetchAll();
//     } catch (PDOException $e) {
//         var_dump($e->getMessage());
//     }
// }

// function findBy($table, $fields = '*', $field, $value)
// {
//     try {
//         $connect = connect();

//         $prepare = $connect->prepare("select {$fields} from {$table} where {$field} = :{$field}");
//         $prepare->execute([
//             $field => $value
//         ]);
//         return $prepare->fetchObject();
//     } catch (PDOException $e) {
//         var_dump($e->getMessage());
//     }
// }
