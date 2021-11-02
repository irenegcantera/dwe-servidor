
<!-- DOCUMENTO QUE ALMACENA TODAS LAS FUNCIONES -->
<?php

// función que crea una tabla que contendrá los días del mes
function crearTablaMes($dia,$mes,$year){
	$diaInicio = jddayofweek(cal_to_jd(CAL_GREGORIAN, $mes, 1, $year));
    $diaInicio = ($diaInicio == 0) ? 7 : $diaInicio;

    $diasMes = cal_days_in_month(CAL_GREGORIAN, $mes, $year);

    $mesRestado = restarMes($mes);
    $mesSumado = sumarMes($mes);
    $yearRestado = $year;
    $yearSumado = $year;

    if($mesRestado == 12){
        $yearRestado--;
    }
    if($mesSumado == 1){
        $yearSumado++;
    }

    echo "<table>";
        echo "<caption>";
            echo "<a href =".$_SERVER['PHP_SELF']."?mes=".$mesRestado."&dia=".$dia."&year=".$yearRestado."> << </a>";
            echo "&nbsp;&nbsp;".pintarMesYear($mes,$year)."&nbsp;&nbsp;";
            echo "<a href =".$_SERVER['PHP_SELF']."?mes=".$mesSumado."&dia=".$dia."&year=".$yearSumado."> >> </a>";
        echo "</caption>";
        echo "<tr>";
            echo "<th>Lunes</th>";
            echo "<th>Martes</th>";
            echo "<th>Miércoles</th>";
            echo "<th>Jueves</th>";
            echo "<th>Viernes</th>";
            echo "<th>Sábado</th>";
            echo "<th>Domingo</th>";
		echo "</tr>";
		
        $d = 1;
        $empezado = false;

        while($d <= $diasMes){
            echo "<tr>";           
            for($j = 1; $j < 8; $j++){ // número columnas
                // si no hemos empezado a pintar y estamos en el día de la semana que 
                // coincide con el 1 del mes, se activa $empezado
                if((!$empezado) && ($j == $diaInicio)){
                    $empezado = true;
                }
                if(($empezado) && ($d>$diasMes)){
                    $empezado = false;
                }
                if($empezado){
                    echo "<td><a href =".$_SERVER['PHP_SELF']."?mes=".$mes."&dia=".$d."&year=".$year.">".$d++."</a></td>";
                }else{
                    echo "<td></td>";
                }
            }
            echo "</tr>";
        }
    echo "</table>";
}

// función que devuelve el mes actual y año actual
function pintarMesYear($mes,$year){
    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    return $meses[$mes-1]." ".date($year);
}

// función que calcula el mes siguiente y el mes anterior
function restarMes($mes){
    if($mes == 1){
        return 12;
    }else{
        return $mes - 1;
    }
}

function sumarMes($mes){
    if($mes ==12){
        return 1;
    }else{
        return $mes + 1;
    }
}

// función que lee datos de un archivo
function leeArchivo($dia,$mes,$year){
    $nombreFichero = $year.$mes.$dia.".txt";
    if(file_exists($nombreFichero)){
        return file_get_contents($nombreFichero); 
    }else{
        return file_put_contents($nombreFichero,"");
    }
}

// función que guarde los datos en un archivo
function guardaArchivo($dia,$mes,$year,$texto){
    $nombreFichero = $year.$mes.$dia.".txt";
    if($texto == "0"){
        $texto = "";
    }
    return file_put_contents($nombreFichero,$texto); // crea el fichero
}

// función que borra el fichero si no se ha introducido datos en el formulario.
function borraArchivo($dia,$mes,$year){
    $nombreFichero = $year.$mes.$dia.".txt";
    if(file_exists($nombreFichero)){
        unlink($nombreFichero);
    }
}
?>