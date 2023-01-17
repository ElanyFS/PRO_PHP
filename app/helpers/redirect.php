<?php

function redirect($to){
    header('Location: ' . $to);
}

function setMessageError($index, $message, $redirectTo)
{
    setFlash($index, $message);
    return redirect($redirectTo);
}