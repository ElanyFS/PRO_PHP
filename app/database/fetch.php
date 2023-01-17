<?php

function All($table)
{

    try {
        $connect = connect();

        $query = $connect->query("select * from {$table}");

        return $query->fetchAll();
    } catch (PDOException $e) {
        var_dump($e->getMessage());
    }
}

function findById($table, $field, $value)
{

    try {
        $connect = connect();
        $prepare = $connect->prepare("select * from {$table} where {$field} = :{$field}");
        $prepare->execute([
            $field => $value
        ]);
        return $prepare->fetch();
    } catch (PDOException $e) {
        var_dump($e->getMessage());
    }
}
