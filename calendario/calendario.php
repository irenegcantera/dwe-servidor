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
    crearTablaMes();
    // if(isset($_GET['tareas'])){
                
    // }else{
    //     echo "NADA";
    // }
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
        <input name="dia" type="hidden" value=""/>
        <input name="mes" type="hidden" value=""/>
        <input name="year" type="hidden" value=""/>
        <input type="submit" value="Enviar"/>
    </form>

        
</body>
</html>

