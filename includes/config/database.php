<?php

function conectarDB(): mysqli
{

    $db = new mysqli($_ENV['HOST'], $_ENV['USERDB'],$_ENV['PASSWORDDB'], $_ENV['DATABASENAME']);
    if (!$db) {
        echo "Error no se pudo conectar";
        exit;
    }

    return $db;
}
