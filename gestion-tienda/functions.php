<?php
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
    return $db;
    // echo "CONEXIÓN REALIZADA";
}

function addProducto($cod,$nombre,$nombre_corto,$descripcion,$foto,$pvp,$familia){ // FUNCIONA
    //ABRIR CONEXIÓN
    $db = connection();
    // comprobar conexión 
    $consulta = "INSERT INTO producto VALUES(".$cod.",".$nombre.",".$nombre_corto.",".$descripcion.",".$foto.",".$pvp.",".$familia.")";
    $registro = $db -> exec($consulta);
    // cerrar conexión
    $db = null;
}
?>