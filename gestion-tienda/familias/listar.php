<?php
    require_once '../conf/config.inc';
    require '../functions.php';
    include '../parts/menu.php';

    // MOSTRAR FOMRULARIO PARA LA BÚQUEDA DE FAMILIAS DE PRODUCTOS


    // mostrar tabla, ultima columna editar y eliminar, te llevará a crear.php
    if (isset($_REQUEST['eliminar']) && $_REQUEST['eliminar'] == true) {
        if(isset($_REQUEST['cod'])){
            deleteFamilia($_REQUEST['cod']);
            showDatosFamilias();
        }
    }else{
        showDatosFamilias();
    }   
?>

