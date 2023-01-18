<?php
function create($table, $value)
{
    try {
        $connect = connect();

        $sql = "insert into {$table} (";
        $sql. = "";
        var_dump($sql);
        die();
    } catch (PDOException $e) {
        var_dump($e->getMessage());
    }
}
