
<!-- DOCUMENTO QUE ALMACENA TODAS LAS FUNCIONES -->
<?php

// función que crea una tabla que contendrá los días del mes
function crearTablaMes($dia,$mes,$year){

    echo "<table style='border: 1px solid black;'>";
        echo "<caption>";
            echo "<a> << </a>";
            echo "&nbsp;&nbsp;$mes $year&nbsp;&nbsp;";
            echo "<a> >> </a>";
        echo "</caption>";
        echo "<tr>";
            echo "<th>Lunes</th><th>Martes</th><th>Miércoles</th><th>Jueves</th><th>Viernes</th><th>Sábado</th><th>Domingo</th>";
        echo "</tr>";
            for($i =  0; $i < 6; $i++){
                echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
            }
        echo "</table>";
}

// función que calcula el mes siguiente y el mes anterior

// función que lee datos de un archivo


// función que guarde los datos en un archivo

?>