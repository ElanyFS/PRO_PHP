<?php

function validate(array $validations)
{
    $result = [];
    $param = '';
    foreach ($validations as $field => $validate) {
        //Validacao simples
        // var_dump($validate);
        // $result = [];
        if (!str_contains($validate, '|')) {
            if (str_contains($validate, ':')) {
                // var_dump($validate);
                [$validate, $param] = explode(':', $validate);
            }

            // $validate($field) e required($field) é a msm coisa
            $result[$field] = $validate($field, $param);
        } else {
            //validacao multipla
            
            $result[$field] = multipleValidate($validate, $field, $param);
        }
    }

    if (in_array(false, $result)) {
        return false;
    }

    return $result;
}

function multipleValidate($validate, $field, $param)
{
    $result = [];
    $explodePipeValidate = explode('|', $validate);
    foreach ($explodePipeValidate as $validate) {
        if (str_contains($validate, ':')) {
            // var_dump($validate);
            [$validate, $param] = explode(':', $validate);
        }

        $result[$field] = $validate($field, $param);

        if(isset($result[$field]) and $result[$field] === false){
            break;
        }
    }
    return $result[$field];
}


