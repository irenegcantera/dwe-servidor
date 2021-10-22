<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel = "stylesheet" type = "text/css" href = "estilos.css">
</head>
<body>
    <h1>CALENDARIO</h1>


    <?php 
    require ('funciones.php');
    if(isset($_GET['dia'])){
        if(isset($_GET['mes'])){
            if(isset($_GET['year'])){
                $dia = $_GET['dia'];
                $mes = $_GET['mes'];
                $year = $_GET['year'];
                crearTablaMes($dia,$mes,$year);
            }else{
                echo "NADA";
            }
        }else{
            echo "NADA";
        }
    }else{
        echo "NADA";
    }



    
    // funcion que te dice dia, mes y año actual, esto son los hidden 
    // se pasan por parámetro en crear tabla 
    // y se coloca en echo
    // otra funcion que calcule mes siguiente y otra mes anterior y te lo saca solo
    ?>

    <form name = "form" action="" method="GET">
        <br>
        <strong>Citas del día:</strong>
        <br>
        <textarea name="tareas" rows="5" cols="54" autofocus></textarea>
        <br>
        <input name="dia" type="hidden" value="<?php echo date("j");?>"/>
        <input name="mes" type="hidden" value="<?php echo date("n");?>"/>
        <input name="year" type="hidden" value="<?php echo date("Y");?>"/>
        <input type="submit" value="Enviar"/>
    </form>

        
</body>
</html>

