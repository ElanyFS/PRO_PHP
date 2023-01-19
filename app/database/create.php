<?php
function create($table, $value)
{
    try {
        if(!arrayAssociative($value)){
            throw new Exception("Erro ao cadastrar.");
        }

        $connect = connect();

        $sql = "insert into {$table} (";
        $sql.=  implode(',', array_keys($value)) . ") values (";
        $sql.= ':' .implode(',:', array_keys($value)) . ")";

        $prepare = $connect->prepare($sql);
        return $prepare->execute($value);
    } catch (PDOException $e) {
        var_dump($e->getMessage());
    }
}
