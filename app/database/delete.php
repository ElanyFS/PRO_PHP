<?php

function delete($table, $id){
    if(!arrayAssociative($id)){
        throw new Exception("Erro: Array associative.");
    }

    $connect = connect();

    $whereId = array_keys($id);

    $sql = "delete from {$table} where {$whereId[0]} = :{$whereId[0]}";

    $prepare = $connect->prepare($sql);

    return $prepare->execute($id);

    // var_dump($sql);
}