<?php
require_once '../conf/config.inc';
include '../parts/menu.php';
include '../parts/formFamilia.php'; // ya incluye las funciones

    //comprobar si se ha rellenado los datos del formulario
    if(isset($_REQUEST['submit']) || isset($_REQUEST['guardar'])){
        if(isset($_REQUEST['cod'])){ // requerido
            $cod = $_REQUEST['cod'];
            if(isset($_REQUEST['nombre'])){ // requerido
                $nombre = $_REQUEST['nombre'];
            }
        }

        if (isset($_REQUEST['submit'])){
            addFamilia($cod,$nombre);
            echo "<h3>DATOS ENVIADOS CORRECTAMENTE</h3>";
        }else if (isset($_REQUEST['guardar'])){
            updateFamilia($cod,$nombre);
            echo "<h3>DATOS GUARDADOS CORRECTAMENTE</h3>";
        }

        
        
    }
?>