<?php
    require_once '../conf/config.inc';
    require '../functions.php';
    include '../parts/menu.php';

    // MOSTRAR FOMRULARIO PARA LA BÚQUEDA DE PRODUCTOS
    include '../parts/formSearch.php';

    if(isset($_REQUEST['buscar']) && isset($_REQUEST['nombre'])){
            searchProductos($_REQUEST['nombre']);
            if(isset($_REQUEST['borrar'])){
                showDatosProductos();
            }
    }else{
        if (isset($_REQUEST['eliminar']) && $_REQUEST['eliminar'] == true) {
            if(isset($_REQUEST['cod'])){
                deleteProducto($_REQUEST['cod']);
                showDatosProductos();
            }
        }else{
            showDatosProductos();
        }   
    }
?>