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

/* Función que desconecta todas las coneziones con la base de datos */
function disconnection(...$conexiones){
    foreach($conexiones as $conexion){
        $conexion = null;
    }
}

/* Función que añade productos a la base de datos */
function addProducto($cod,$nombre_corto,$descripcion,$foto,$pvp,$familia){ 
    //ABRIR CONEXIÓN
    $db = connection();
    try{
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
    
        $registro = $db -> exec($consulta);
        // cerrar conexión e instancias
        disconnection($registro,$consulta,$db);
    }catch(Exception $e){
        echo "Error: " . $e->getMessage();
    }
}

/* Función que añade familias de productos a la base de datos */
function addFamilia($cod,$nombre){ 
    //ABRIR CONEXIÓN
    $db = connection();
    try{
        $consulta = "INSERT INTO familia(cod,nombre) VALUES('".$cod."','".$nombre."')";
        $registro = $db -> exec($consulta);
        // cerrar conexión e instancias
        disconnection($registro,$consulta,$db);
    }catch(Exception $e){
        echo "Error: " . $e->getMessage();
    }
}

/* Función que añade tiendas a la base de datos */
function addTienda($nombre,$tlf){ 
    //ABRIR CONEXIÓN
    $db = connection();
    try{
        if ($tlf == NULL){
            $registro = "INSERT INTO tienda(nombre) VALUES('".$nombre."')";
        }else{
            $registro = "INSERT INTO tienda(Nombre,tlf) VALUES('".$nombre."','".$tlf."')";
        }
    
        $registrado = $db -> exec($registro);
        // cerrar conexión e instancias
        disconnection($registrado,$registro,$db);
    }catch(Exception $e){
        echo "Error: " . $e->getMessage();
    }
}

/* Función que actualiza productos de la base de datos */
function updateProducto($cod,$nombre_corto,$desc,$foto,$pvp,$familia){ 
    //ABRIR CONEXIÓN
    $db = connection();
    try{
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
        
        $registro = $db -> exec($consulta);
        // cerrar conexión e instancias
        disconnection($registro,$consulta,$db);
    }catch(Exception $e){
        echo "Error: " . $e->getMessage();
    }
}

/* Función que actualiza datos de familias de productos de la base de datos */
function updateFamilia($cod,$nombre){ 
    //ABRIR CONEXIÓN
    $db = connection();
    try{
        $consulta = "UPDATE familia SET nombre ='".$nombre."' WHERE cod = '".$cod."'";
        $registro = $db -> exec($consulta);
        // cerrar conexión e instancias
        disconnection($registro,$consulta,$db);
    }catch(Exception $e){
        echo "Error: " . $e->getMessage();
    }
}

/* Función que actualiza las tiendas de la base de datos */
function updateTienda($cod,$nombre,$tlf){ 
    //ABRIR CONEXIÓN
    $db = connection();
    try{
        if ($tlf == NULL){
            $consulta = "UPDATE tienda SET nombre = '".$nombre."' WHERE cod = ".$cod;
        }else{
            $consulta = "UPDATE tienda SET nombre = '".$nombre."', tlf = '".$tlf."' WHERE cod = ".$cod;
        }
        $registro = $db -> exec($consulta);
        // cerrar conexión e instancias
        disconnection($registro,$consulta,$db);
    }catch(Exception $e){
        echo "Error: " . $e -> getMessage();
    }
}

/* Función que borra un producto */
function deleteProducto($cod){
    // abrir conexión
    $db = connection();
    try{
        $consulta = $db->query("SELECT foto FROM producto WHERE cod ='".$cod."'",PDO::FETCH_OBJ);
        while($row = $consulta -> fetch()){
            $ruta = $row -> foto;
            unlink($ruta);
        }
        $registro =  $db -> exec("DELETE FROM producto WHERE cod='".$cod."'");
        // cerrar conexión e instancias
        disconnection($registro,$row,$consulta,$db);
    }catch(Exception $e){
        echo "Error: " . $e->getMessage();
    }
}

/* Función que borra una familia de un producto */
function deleteFamilia($cod){
    // abrir conexión
    $db = connection();
    try{
        $registro =  $db -> exec("DELETE FROM familia WHERE cod='".$cod."'");
        // cerrar conexión e instancias
        disconnection($registro,$db);
    }catch(Exception $e){
        echo "Error: " . $e->getMessage();
    }    
}

/* Función que borra una tienda */
function deleteTienda($cod){
    // abrir conexión
    $db = connection();
    try{
        $registro =  $db -> exec("DELETE FROM tienda WHERE cod='".$cod."'");
        // cerrar conexión e instancias
        disconnection($registro,$db);
    }catch(Exception $e){
        echo "Error: " . $e->getMessage();
    }   
}
?>