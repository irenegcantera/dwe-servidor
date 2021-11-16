<?php
// ARCHIVO PHP CON FUNCIONES DE MANTENIMIENTO DE LA APLICACIÓN
/* Función que conecta con la base de datos USANDO PDO */
function connection(){ 
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
}

/* Función que añade productos a la base de datos */
function addProducto($cod,$nombre,$nombre_corto,$descripcion,$foto,$pvp,$familia){ 
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
function addFamilia($cod,$nombre){ 
    //ABRIR CONEXIÓN
    $db = connection();
    $consulta = "INSERT INTO familia(cod,nombre) VALUES('".$cod."','".$nombre."')";
    $registro = $db -> exec($consulta);
    // cerrar conexión e instancias
    $registro = null;
    $consulta = null;
    $db = null;
}

/* Función que añade tiendas a la base de datos */
function addTienda($nombre,$tlf){ 
    //ABRIR CONEXIÓN
    $db = connection();

    if ($tlf == NULL){
        $consulta = "INSERT INTO tienda(nombre) VALUES('".$nombre."')";
    }else{
        $consulta = "INSERT INTO tienda(nombre,tlf) VALUES('".$nombre."','".$tlf."')";
    }

    $registro = $db -> exec($consulta);
    // cerrar conexión e instancias
    $registro = null;
    $consulta = null;
    $db = null;
}

/* Función que actualiza productos de la base de datos */
function updateProducto($cod,$nombre,$nombre_corto,$desc,$foto,$pvp,$familia){ 
    //ABRIR CONEXIÓN
    $db = connection();
    if ($nombre == NULL){
        if($desc == NULL){
            if($foto == NULL){
                $consulta = "UPDATE producto SET nombre_corto='".$nombre_corto."', PVP = ".$pvp.", familia ='".$familia."' WHERE cod = '".$cod."'";
            }else{
                $consulta = "UPDATE producto SET nombre_corto='".$nombre_corto."', foto = '".$foto."', PVP = ".$pvp.", familia ='".$familia."' WHERE cod = '".$cod."'";
            }
        }else{
            if($foto == NULL){
                $consulta = "UPDATE producto SET nombre_corto='".$nombre_corto."', descripcion = '".$desc."', PVP = ".$pvp.", familia ='".$familia."' WHERE cod = '".$cod."'";
            }else{
                $consulta = "UPDATE producto SET nombre_corto='".$nombre_corto."', descripcion = '".$desc."', foto = '".$foto."', PVP = ".$pvp.", familia ='".$familia."' WHERE cod = '".$cod."'";
            }
        }
    }else{
        if($desc == NULL){
            if($foto == NULL){
                $consulta = "UPDATE producto SET nombre = '".$nombre."',nombre_corto='".$nombre_corto."', PVP = ".$pvp.", familia ='".$familia."' WHERE cod = '".$cod."'";
            }else{
                $consulta = "UPDATE producto SET nombre = '".$nombre."',nombre_corto='".$nombre_corto."', foto = '".$foto."', PVP = ".$pvp.", familia ='".$familia."' WHERE cod = '".$cod."'";
            }
        }else{
            if($foto == NULL){
                $consulta = "UPDATE producto SET nombre = '".$nombre."',nombre_corto='".$nombre_corto."', descripcion = '".$desc."', PVP = ".$pvp.", familia ='".$familia."' WHERE cod = '".$cod."'";
            }else{
                $consulta = "UPDATE producto SET nombre = '".$nombre."',nombre_corto='".$nombre_corto."', descripcion = '".$desc."', foto = '".$foto."', PVP = ".$pvp.", familia ='".$familia."' WHERE cod = '".$cod."'";
            }
        }
    }
    
    $registro = $db -> exec($consulta);
    // cerrar conexión e instancias
    $registro = null;
    $consulta = null;
    $db = null;
}

/* Función que actualiza datos de familias de productos de la base de datos */
function updateFamilia($cod,$nombre){ 
    //ABRIR CONEXIÓN
    $db = connection();
    $consulta = "UPDATE familia SET nombre ='".$nombre."' WHERE cod = '".$cod."'";
    $registro = $db -> exec($consulta);
    // cerrar conexión e instancias
    $registro = null;
    $consulta = null;
    $db = null;
}

/* Función que actualiza las tiendas de la base de datos */
function updateTienda($cod,$nombre,$tlf){ 
    //ABRIR CONEXIÓN
    $db = connection();

    if ($tlf == NULL){
        $consulta = "UPDATE tienda SET nombre = '".$nombre."' WHERE cod = ".$cod;
    }else{
        $consulta = "UPDATE tienda SET nombre = '".$nombre."', tlf = '".$tlf."' WHERE cod = ".$cod;
    }

    $registro = $db -> exec($consulta);
    // cerrar conexión e instancias
    $registro = null;
    $consulta = null;
    $db = null;
}

/* Función que borra un producto */
function deleteProducto($cod){
    // abrir conexión
    $db = connection();
    $registros =  $db -> exec("DELETE FROM producto WHERE cod='".$cod."'");
    // cerrar conexión e instancias
    $registro = null;
    $db = null;
}

/* Función que borra una familia de un producto */
function deleteFamilia($cod){
    // abrir conexión
    $db = connection();
    $registros =  $db -> exec("DELETE FROM familia WHERE cod='".$cod."'");
    // cerrar conexión e instancias
    $registro = null;
    $db = null;
}

/* Función que borra una tienda */
function deleteTienda($cod){
    // abrir conexión
    $db = connection();
    $registros =  $db -> exec("DELETE FROM tienda WHERE cod='".$cod."'");
    // cerrar conexión e instancias
    $registro = null;
    $db = null;
}
?>