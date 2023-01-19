<?php

function update($table, $fields, $id){
    if(!arrayAssociative($fields) || (!arrayAssociative($id))){
        throw new "Erro"
    }
}