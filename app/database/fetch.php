<?php

function all($table, $fields = '*'){
    try{
        $connect = connect();

        $query = $connect->query("Select {$fields} from {$table}");
        return $query->fetchAll();
    }catch(PDOException $e){
        var_dump($e->getMessage());
    }
}

function findBy($table, $fields = '*', $field, $value){
    try{
        $connect = connect();

        $prepare = $connect->prepare("select {$fields} from {$table} where {$field} = :{$field}");
        $prepare->execute([
            $field => $value
        ]);
        return $prepare->fetchObject();
    }catch(PDOException $e){
        var_dump($e->getMessage());
    }
}
