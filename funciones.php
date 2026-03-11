<?php

function validarDNI($dni){
    $dni=strtoupper(trim($dni));

    if (!preg_match("/[0-9]{8}[A-Z]$/", $dni)) {
        return false;
    }

    $numero = substr($dni,0,8);
    $letra = substr($dni, -1);

    $letras = "TRWAGMYFPDXBNJZSQVHLCKE";

    return $letra == $letras[$numero % 23];
}