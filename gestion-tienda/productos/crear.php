<?php
require_once '../conf/config.inc';
include '../parts/menu.php';
include '../parts/form.php'; // ya incluye las funciones

    //comprobar si se ha rellenado los datos del formulario
    if(isset($_REQUEST['submit'])){
        if(isset($_REQUEST['cod'])){ // requerido
            $cod = $_REQUEST['cod'];
        }

        if(isset($_REQUEST['nombre '])){
            $nombre = $_REQUEST['nombre '];
        } else{
            $nombre = NULL;
        }

        if (isset($_REQUEST['ncorto'])){ // requerido
            $ncorto = $_REQUEST['ncorto'];
        }

        if(isset($_REQUEST['desc '])){
            $desc = $_REQUEST['desc '];
        } else{
            $desc = NULL;
        }

        $foto = NULL;

        if(isset($_REQUEST['pvp'])){ // requerido
            $pvp = (float)$_REQUEST['pvp'];
        }

        if(isset($_REQUEST['familia'])){ // requerido
            $fam = $_REQUEST['familia'];
        }
        
        addProducto($cod, $nombre, $ncorto, $desc, $foto, $pvp, $fam); 
    }
?>