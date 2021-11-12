<?php

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

/* Función que añade productos a la base de datos */
function addProducto($cod,$nombre,$nombre_corto,$descripcion,$foto,$pvp,$familia){ // FUNCIONA
    //ABRIR CONEXIÓN
    $db = connection();
    // comprobar conexión 
    $consulta = "INSERT INTO producto VALUES(".$cod.",".$nombre.",".$nombre_corto.",".$descripcion.",".$foto.",".$pvp.",".$familia.")";
    $registro = $db -> exec($consulta);
    // cerrar conexión
    $db = null;
}


/* Función que obtiene el directorio en el que se ejecuta crear.php */
function obtainDirectory(){
    $dirArray = explode("/", $_SERVER['PHP_SELF']);
    foreach($dirArray as $dir){
        if($dir == "productos"){
            return "productos";
        }else if($dir == "familias"){
            return "familias";
        }else if($dir == "tiendas"){
            return "tiendas";
        }
    }
}
?>