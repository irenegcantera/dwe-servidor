<?php
require_once '../conf/config.inc';
include '../parts/menu.php';
include '../parts/form.php'; // ya incluye las funciones

    //comprobar si se ha rellenado los datos del formulario
    if(isset($_REQUEST['submit'])){
        if(isset($_REQUEST['cod'])){ // requerido
            $cod = $_REQUEST['cod'];
        }

        if(isset($_REQUEST['nombre'])){ // requerido
            $nombre = $_REQUEST['nombre'];
        }

        addFamilia($cod,$nombre);
    }
?>