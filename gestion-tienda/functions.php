1<?php
require 'config.inc';

// ARCHIVO PHP CON FUNCIONES DE LA APLICACIÓN
/* Función que conecta con la base de datos USANDO PDO */
function connection(){ // FUNCIONA
    try {
        $db = new PDO("mysql:host=".LOCALHOST.";port=".PORT.";dbname=".DB,USER,PASSWORD);
    }catch(PDOException $pdo){
        echo $pdo -> getMessage();
        exit; // finaliza el proceso
    }catch(Exception $e){
        echo $e -> getMessage();
        exit; // finaliza el proceso
    }
    echo "CONEXIÓN REALIZADA";
}




?>