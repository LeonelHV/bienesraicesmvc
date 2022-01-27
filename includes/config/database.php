<?php

function conectarDB(): mysqli
{

    $db = new mysqli(getenv('HOST'), getenv('USERDB'),getenv('PASSWORDDB'), getenv('DATABASENAME'));
    if (!$db) {
        echo "Error no se pudo conectar";
        exit;
    }

    return $db;
}
