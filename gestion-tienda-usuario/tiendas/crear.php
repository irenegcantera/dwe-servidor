<?php
require_once '../conf/config.inc';
include '../parts/menu.php';
include '../checkAuthCookie.php';
include '../parts/formTienda.php'; // ya incluye las funciones

    //comprobar si se ha rellenado los datos del formulario
    if(isset($_REQUEST['submit'])){
        if(isset($_REQUEST['nombre'])){ // requerido
            $nombre = strtoupper($_REQUEST['nombre']);
            if(isset($_REQUEST['tlf'])){ 
                if(is_numeric($_REQUEST['tlf']) && strlen($_REQUEST['tlf']) == 9){
                    $telefono = $_REQUEST['tlf'];
                    echo "<h3>DATOS ENVIADOS CORRECTAMENTE</h3>";
                }else{
                    $telefono = NULL;
                    echo "<br><br>El teléfono no cumple con  los criterios.";
                    echo "<h3>NOMBRE ENVIADO CORRECTAMENTE</h3>";
                }
                addTienda($nombre,$telefono);
            }else{ 
                $telefono = NULL;
                addTienda($nombre,$telefono);
                echo "<h3>DATOS ENVIADOS CORRECTAMENTE</h3>";
            }
        }
    }

    if(isset($_REQUEST['guardar'])){
        if(!empty($_REQUEST['cod'])){ 
            $cod = $_REQUEST['cod'];
            if(isset($_REQUEST['nombre'])){ // requerido
                $nombre = strtoupper($_REQUEST['nombre']);
                if(isset($_REQUEST['tlf'])){ 
                    if(is_numeric($_REQUEST['tlf']) && strlen($_REQUEST['tlf']) == 9){
                        $telefono = $_REQUEST['tlf'];
                        echo $telefono;
                        echo "<h3>DATOS GUARDADOS CORRECTAMENTE</h3>";
                    }else{
                        $telefono = NULL;
                        echo "<br><br>El teléfono no cumple con  los criterios.";
                        echo "<h3>NOMBRE GUARDADOS CORRECTAMENTE</h3>";
                    }
                    updateTienda($cod,$nombre,$telefono);
                }else{ 
                    $telefono = NULL;
                    updateTienda($cod,$nombre,$telefono);
                    echo "<h3>DATOS GUARDADOS CORRECTAMENTE</h3>";
                }
            }
        }
    }
?>