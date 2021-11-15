<?php
    require_once '../conf/config.inc';
    require '../functions.php';
    include '../parts/menu.php';

    // MOSTRAR FOMRULARIO PARA LA BÚQUEDA DE TIENDAS


    // mostrar tabla, ultima columna editar y eliminas, te llevará a crear.php
    if (isset($_REQUEST['eliminar']) && $_REQUEST['eliminar'] == true) {
        if(isset($_REQUEST['cod'])){
            deleteTienda($_REQUEST['cod']);
            showDatosTiendas();
        }
    }else{
        showDatosTiendas();
    }   
?>

