<!-- DOCUMENTO QUE ALMACENA TODAS LAS FUNCIONES -->
<?php

/* Función que crea una tabla que contendrá los días de cada mes y año */
function crearTablaMes($dia,$mes,$year){
    // Día de la semana en número, si es 0 pasa a ser 7
	$diaInicio = jddayofweek(cal_to_jd(CAL_GREGORIAN, $mes, 1, $year)); 
    $diaInicio = ($diaInicio == 0) ? 7 : $diaInicio;
    // 0 domingo
    // 1 lunes
    // 2 Martes
    // 3 miercoles
    // 4 jueves
    // 5 viernes
    // 6 sabado
    // 7 = 0 domingo

    // Número de días que tiene un mes
    $diasMes = cal_days_in_month(CAL_GREGORIAN, $mes, $year);

    //tomo el nombre del mes que hay que imprimir
    $nombre_mes = pintarMes($mes);

    // Mostramos la tabla por pantalla
    echo "<table>";
        echo "<caption>";

        // Calculo el mes y año del mes anterior
        $mes_anterior = $mes - 1;
        $year_anterior = $year;
        if ($mes_anterior == 0){
            $year_anterior--;
            $mes_anterior = 12;
        }

        echo "<a href =".$_SERVER['PHP_SELF']."?mes=".$mes_anterior."&dia=".$dia."&year=".$year_anterior."> << </a>";
        echo "&nbsp;&nbsp;".$nombre_mes." ".$year."&nbsp;&nbsp;";

        // Calculo el mes y año del mes siguiente
        $mes_siguiente = $mes + 1;
        $year_siguiente = $year;
        if ($mes_siguiente == 13){
            $year_siguiente++;
            $mes_siguiente = 1;
        } 
        
        echo "<a href =".$_SERVER['PHP_SELF']."?mes=".$mes_siguiente."&dia=".$dia."&year=".$year_siguiente."> >> </a>";
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
		
        // Aquí comienza a pintarse los números en la celda
        $d = 1;
        $empezado = false;

        while($d <= $diasMes){
            echo "<tr>";           
            for($j = 1; $j < 8; $j++){ // número columnas
                // Si no hemos empezado a pintar y estamos en el día de la semana que 
                // coincide con el 1 del mes, se activa $empezado
                if((!$empezado) && ($j == $diaInicio)){
                    $empezado = true;
                }
                if(($empezado) && ($d>$diasMes)){
                    $empezado = false;
                }
                if($empezado){
                    if($d == $dia){ // pinta de color amarillo el día seleccionado
                        echo "<td style='background-color: yellow'><a href =".$_SERVER['PHP_SELF']."?mes=".$mes."&dia=".$d."&year=".$year.">".$d++."</a></td>";
                    }else{
                        echo "<td><a href =".$_SERVER['PHP_SELF']."?mes=".$mes."&dia=".$d."&year=".$year.">".$d++."</a></td>";
                    }
                    
                }else{
                    echo "<td></td>";
                }
                
            }
            echo "</tr>";
        }
    echo "</table>";
}

/* Función que devuelve el mes actual y año actual */
function pintarMes($mes){
    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    return $meses[$mes-1];
}

/* Función que calcula el mes anterior */
function restarMes($mes){
    if($mes == 1){
        return 12;
    }else{
        return $mes - 1;
    }
}

/* Función que calcula el mes siguiente */
function sumarMes($mes){
    if($mes == 12){
        return 1;
    }else{
        return $mes + 1;
    }
}

/* Función que lee un fichero de un día, mes y año concreto */
function leeArchivo($dia,$mes,$year){
    $rutaFichero = "./files/".$year.$mes.$dia.".txt";
    // Comprobar si existe o no el fichero
    if(file_exists($rutaFichero)){
        return file_get_contents($rutaFichero); 
    }
}

/* Función que guarda en un fichero el texto de un día, mes y año concreto */
function guardaArchivo($dia,$mes,$year,$texto){
    $rutaFichero = "./files/".$year.$mes.$dia.".txt";
    return file_put_contents($rutaFichero,$texto); // también crea el fichero
}

/* Función que borra un fichero de un día, mes y año concreto si existe*/
function borraArchivo($dia,$mes,$year){
    $rutaFichero = "./files/".$year.$mes.$dia.".txt";
    if(file_exists($rutaFichero)){
        unlink($rutaFichero);
    }
}
?>