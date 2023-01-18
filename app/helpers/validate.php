<?php

function validate(array $validations)
{
    $result = [];
    $param = '';
    foreach ($validations as $field => $validate) {
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
            $explodePipeValidate = explode('|', $validate);
            foreach ($explodePipeValidate as $validate) {
                if (str_contains($validate, ':')) {
                    // var_dump($validate);
                    [$validate, $param] = explode(':', $validate);
                }
                $result[$field] = $validate($field, $param);
            }
        }
    }

    if (in_array(false, $result)) {
        return false;
    }

    return $result;
}

function required($field)
{
    // var_dump("Required {$field}");

    if ($_POST[$field] == '') {
        setFlash($field, 'O campo é obrigatório');
        return false;
    }

    return filter_input(INPUT_POST, $field, FILTER_SANITIZE_STRING);
}

function email($field)
{
    $emailIsValid = filter_input(INPUT_POST, $field, FILTER_VALIDATE_EMAIL);

    if (!$emailIsValid) {
        setFlash($field, 'E-mail inválido.');
        return false;
    }

    return filter_input(INPUT_POST, $field, FILTER_SANITIZE_STRING);
}

function unique($field, $param)
{
    $value = filter_input(INPUT_POST, $field, FILTER_SANITIZE_STRING);
    $user = findBy($param,'*', $field, $value);

    if($user){
        setFlash($field, 'E-mail já cadastrado.');
        return false;
    }

    return $value;
}

function maxlen($field, $param)
{
    $value = filter_input(INPUT_POST, $field, FILTER_SANITIZE_STRING);

    if(strlen($value) > $param){
        setFlash($field, "Senha deve ser menor que {$param} caracteres.");
        return false;
    }

    return $value;
}
