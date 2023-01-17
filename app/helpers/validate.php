<?php

function validate(array $validations){
    $result = [];
    foreach($validations as $field =>$validate){
        // var_dump($validate);
        // $result = [];
        if(!str_contains($validate, '|')){

            // $validate($field) e required($field) é a msm coisa
            $result[$field] = $validate($field);
        }else{

        }

       if(in_array(false, $result)){
        return false;
       }

       return $result;
    }
}

function required($field){
    // var_dump("Required {$field}");

    if($_POST[$field] == ''){
        setFlash($field, 'O campo é obrigatório');
        return false;
    }

    return filter_input(INPUT_POST, $field, FILTER_SANITIZE_STRING);
}