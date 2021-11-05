<?php 
    include 'components/navbar.php';
    require 'functions.php';

    // MOSTRAR LA TABLA POR PANTALLA
    $datos = getContactos(); //obtener los datos
    showContactos($datos);
    // showContactos(getContactos());

    include 'components/footer.php';
?>