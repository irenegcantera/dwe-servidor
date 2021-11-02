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
	
	if(isset($_GET['dia']) && isset($_GET['mes']) && isset($_GET['year'])){
        $dia = $_GET['dia'];
        $mes = $_GET['mes'];
        $year = $_GET['year'];
    }else{
        $dia = date("j");
        $mes = date("n");
        $year = date("Y");
    }

    crearTablaMes($dia,$mes,$year);
	
    if(isset($_GET['enviar'])){
        if(isset($_GET['tareas'])){
            $texto = $_GET['tareas'];
            $nombreFichero = $year.$mes.$dia.".txt";
            if(file_exists($nombreFichero)){
                $tareas = guardaArchivo($dia,$mes,$year, $texto);
            }
        }else{
            borraArchivo($dia,$mes,$year);
        }
    }else{
        $tareas = leeArchivo($dia,$mes,$year);
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

