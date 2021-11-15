<?php
    require_once '../conf/config.inc';
    require '../functions.php';
    include '../parts/menu.php';

    // MOSTRAR FOMRULARIO PARA LA BÚQUEDA DE PRODUCTOS


    // mostrar tabla, ultima columna editar y eliminas, te llevará a crear.php
    if (isset($_REQUEST['eliminar']) && $_REQUEST['eliminar'] == true) {
        if(isset($_REQUEST['cod'])){
            deleteProducto($_REQUEST['cod']);
            showDatosProductos();
        }
    }else{
        showDatosProductos();
    }   
?>

