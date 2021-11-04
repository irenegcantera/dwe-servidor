<?php 
    include 'components/navbar.php';
    require 'functions.php';

    // MOSTRAR LA TABLA POR PANTALLA
    echo "<br><table border='1'>";
    echo "<tr>";
        echo "<th>Nombre</th>";
        echo "<th>Teléfono</th>";
        echo "<th>Foto</th>";
        echo "<th>Operaciones</th>";
    echo "</tr>";
    $datos = getContactos(); //obtener los datos
    foreach($datos as $key => $value){
        echo "<tr>";
        foreach($value as $k => $v){
            echo "<td>$v</td>";
        }
        echo "<td>OPERACIONES</td>";
        echo "</tr>";
    }
    echo "</table><br>";

include 'components/footer.php';
?>