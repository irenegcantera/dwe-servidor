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
    //echo "CONEXIÓN REALIZADA";
    return $db;
}

/* Función que añade productos a la base de datos */
function addProducto($cod,$nombre,$nombre_corto,$descripcion,$foto,$pvp,$familia){ // FUNCIONA
    //ABRIR CONEXIÓN
    $db = connection();
    if ($nombre == NULL){
        if($descripcion == NULL){
            if($foto == NULL){
                $consulta = "INSERT INTO producto(cod,nombre_corto,PVP,familia) VALUES('".$cod."','".$nombre_corto."',".$pvp.",'".$familia."')";
            }else{
                $consulta = "INSERT INTO producto(cod,nombre_corto,foto,PVP,familia) VALUES('".$cod."','".$nombre_corto."','".$foto."',".$pvp.",'".$familia."')";
            }
        }else{
            if($foto == NULL){
                $consulta = "INSERT INTO producto(cod,nombre_corto,descripcion,PVP,familia) VALUES('".$cod."','".$nombre_corto."','".$descripcion."',".$pvp.",'".$familia."')";
            }else{
                $consulta = "INSERT INTO producto(cod,nombre_corto,descripcion,foto,PVP,familia) VALUES('".$cod."','".$nombre_corto."','".$descripcion."','".$foto."',".$pvp.",'".$familia."')";
            }
        }
    }else{
        if($descripcion == NULL){
            if($foto == NULL){
                $consulta = "INSERT INTO producto(cod,nombre,nombre_corto,PVP,familia) VALUES('".$cod."','".$nombre."','".$nombre_corto."',".$pvp.",'".$familia."')";
            }else{
                $consulta = "INSERT INTO producto(cod,nombre,nombre_corto,foto,PVP,familia) VALUES('".$cod."','".$nombre."','".$nombre_corto."','".$foto."',".$pvp.",'".$familia."')";
            }
        }else{
            if($foto == NULL){
                $consulta = "INSERT INTO producto(cod,nombre,nombre_corto,descripcion,PVP,familia) VALUES('".$cod."','".$nombre."','".$nombre_corto."','".$descripcion."',".$pvp.",'".$familia."')";
            }else{
                $consulta = "INSERT INTO producto(cod,nombre,nombre_corto,descripcion,foto,PVP,familia) VALUES('".$cod."','".$nombre."','".$nombre_corto."','".$descripcion."','".$foto."',".$pvp.",'".$familia."')";
            }
        }
    }
    
    $registro = $db -> exec($consulta);
    // cerrar conexión e instancias
    $registro = null;
    $consulta = null;
    $db = null;
}

/* Función que añade familias de productos a la base de datos */
function addFamilia($cod,$nombre){ // FUNCIONA
    //ABRIR CONEXIÓN
    $db = connection();
    $consulta = "INSERT INTO familia(cod,nombre) VALUES('".$cod."','".$nombre."')";
    $registro = $db -> exec($consulta);
    // cerrar conexión e instancias
    $registro = null;
    $consulta = null;
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