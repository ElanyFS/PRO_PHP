<?php

function update($table, $fields, $id){
    if(!arrayAssociative($fields) || (!arrayAssociative($id))){
        throw new Exception("Erro: Array associative.");
    }

    $connect = connect();

    $sql = "update {$table} set ";
    foreach(array_keys($fields) as $field){
        $sql .= "{$field} = :{$field}, ";
    }

    $sql = trim($sql, ', ');

    $whereID = array_keys($id);

    $sql .= " where {$whereID[0]} = :{$whereID[0]}";

    $data = array_merge($fields, $id);

    $prepare = $connect->prepare($sql);
    $prepare->execute($data);

    return $prepare->rowCount();
}