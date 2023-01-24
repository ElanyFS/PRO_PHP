<?php

$query = [];

function read($table, $fields = '*')
{
    global $query;
    $query['read'] = true;

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

    $query['execute'] = [$field => $value];

    $query['sql'] = "{$query['sql']} where {$field} {$operator} :{$field}";
}

function execute()
{
    global $query;

    $connect = connect();

    $prepare = $connect->prepare($query['sql']);
    $prepare->execute($query['execute']);

    // var_dump($query['sql']);
    // var_dump($prepare);

    // return $prepare->fetchObject();
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
