<?php

function validate(array $validations, $persistInput = false, $checkCsrf = false)
{

    if($checkCsrf){
        checkCsrf();
    }

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
     
    if($persistInput){
        setOld();
    }

    if (in_array(false, $result, true)) {
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

        if($result[$field] === false || $result[$field] === null ){
            break;
        }
    }
    return $result[$field];
}