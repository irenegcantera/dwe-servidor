
<!-- DOCUMENTO QUE ALMACENA TODAS LAS FUNCIONES -->
<?php

// función que crea una tabla que contendrá los días del mes
function crearTablaMes(){
    echo "<table>";
        echo "<caption>";
            echo "<a> << </a>";
            echo "&nbsp;&nbsp;". mesYearActual()."&nbsp;&nbsp;";
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


// " . $_SERVER['PHP_SELF'] . "?a=" . ++$a . "

// función que devuelve el mes actual y año actual
function mesYearActual(){
    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    return $meses[date('n')-1]." ".date("Y");
}

// función que calcula el mes siguiente y el mes anterior
// function mesSiguiente(){
//     $fecha = date('Y-m-j');
//     $nuevafecha = strtotime ( '+1 month' , strtotime ( $fecha ) ) ;
//     $nuevafecha = date ( 'Y-m-j' , $nuevafecha );
//     echo $nuevafecha;
// }

// función que lee datos de un archivo


// función que guarde los datos en un archivo

?>