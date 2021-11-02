<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario de tareas</title>
    <link rel = "stylesheet" type = "text/css" href = "estilos.css">
</head>
<body>
    <h1>CALENDARIO</h1>

    <?php 
    require 'funciones.php';
	
    /* Comprobamos si se han obtenido los valores de día, mes y año. Si es cierto se guardarán en variables y sino se obtendrá la fecha actual */
	if(isset($_GET['dia']) && isset($_GET['mes']) && isset($_GET['year'])){
        $dia = $_GET['dia'];
        $mes = $_GET['mes'];
        $year = $_GET['year'];
    }else{
        $dia = date("j");
        $mes = date("n");
        $year = date("Y");
    }

    crearTablaMes($dia,$mes,$year); // Llamada a la función para crear la tabla del calendario con los valores guardados anteriormente
	
    /* Si se le ha dado al botón enviar y existe un valor de tareas, se guardará en una variable. Se comprueba si existe el fichero del año, mes y día, si existe se guardará las tareas en el fichero.
    En el caso de que no se escribiera tareas y se envia, se borrará el fichero.
    Si no se le ha dado a enviar en un principio se mostrará las tareas que se hayan enviado anteriormente.*/
    if(isset($_GET['enviar'])){
        if(isset($_GET['tareas'])){
            $texto = $_GET['tareas'];
            $nombreFichero = $year.$mes.$dia.".txt";
            if(file_exists($nombreFichero)){
                $tareas = guardaArchivo($dia,$mes,$year, $texto);
            } // Falta lo que pasaría si no existe el fichero
        }else{
            borraArchivo($dia,$mes,$year);
        }
    }else{
        $tareas = leeArchivo($dia,$mes,$year);
        // Si las tareas es igual a 0, no se mostrará nada
        if($tareas == "0"){
            $tareas = null;
        }
    }
    ?>
    
    <form name = "form" action="" method="GET">
        <br>
        <strong>Citas del día:</strong>
        <br>
        <textarea name="tareas" rows="5" cols="54" autofocus><?php echo $tareas;?></textarea>
        <br>
        <input name="dia" type="hidden" value="<?php echo $dia;?>"/>
        <input name="mes" type="hidden" value="<?php echo $mes;?>"/>
        <input name="year" type="hidden" value="<?php echo $year;?>"/>
        <input name="enviar" type="submit" value="Enviar"/>
    </form> 
</body>
</html>

