<?php 
    include 'components/navbar.php';
    require 'functions.php';

    // MOSTRAR LA TABLA POR PANTALLA
    $datos = getContactos(); //obtener los datos
    if(!empty($datos)){ 
        // Esta condición es por si se quiere eliminar el contacto
        if(isset($_REQUEST['nombre'])){
            deleteContacto($_REQUEST['nombre']); // borrar y guardar datos
            $datosActualizados = getContactos(); // obtener nuevos datos
            showContactos($datosActualizados);
        }else{
            showContactos($datos);
        }
    }else{
        echo "<p>NO HAY NINGÚN CONTACTO EN LA AGENDA</p>";
    }

    include 'components/footer.php';
?>