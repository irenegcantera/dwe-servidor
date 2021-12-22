<?php
require_once '../conf/config.inc';
include '../parts/menu.php';
include '../parts/formProducto.php'; // ya incluye las funciones

    //comprobar si se ha rellenado los datos del formulario
    if(isset($_REQUEST['submit'])){
        if(isset($_REQUEST['cod'])){ // requerido
            $cod = strtoupper($_REQUEST['cod']);
        }

        if (isset($_REQUEST['ncorto'])){ // requerido
            $ncorto = $_REQUEST['ncorto'];
        }

        if(isset($_REQUEST['desc'])){
            $desc = $_REQUEST['desc'];
        }else{
            $desc = NULL;
        }

        if(isset($_FILES['foto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK){
            $foto = moveRenameImg($cod,$_FILES['foto']);
        }else{
            $foto = null;
        }
        
        if(isset($_REQUEST['pvp'])){ // requerido
            $pvp = (float)$_REQUEST['pvp'];
        }

        if(isset($_REQUEST['familia'])){ // requerido
            $fam = strtoupper($_REQUEST['familia']);
        }

        addProducto($cod,$ncorto, $desc, $foto, $pvp, $fam);
        echo "<h3>DATOS ENVIADOS CORRECTAMENTE</h3>";
    }

    if(isset($_REQUEST['guardar'])){
        if(isset($_REQUEST['cod'])){ // requerido
            $cod = strtoupper($_REQUEST['cod']);
        }

        if (isset($_REQUEST['ncorto'])){ // requerido
            $ncorto = $_REQUEST['ncorto'];
        }

        if(isset($_REQUEST['desc'])){
            $desc = $_REQUEST['desc'];
        }else{
            $desc = NULL;
        }

        if(isset($_FILES['foto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK){
            $foto = moveRenameImg($cod,$_FILES['foto']);
        }else{
            $foto = null;
        }
        
        if(isset($_REQUEST['pvp'])){ // requerido
            $pvp = (float)$_REQUEST['pvp'];
        }

        if(isset($_REQUEST['familia'])){ // requerido
            $fam = strtoupper($_REQUEST['familia']);
        }

        updateProducto($cod,$ncorto, $desc, $foto, $pvp, $fam);   
        echo "<h3>DATOS GUARDADOS CORRECTAMENTE</h3>";         
    }
?>