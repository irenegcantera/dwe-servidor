<?php
$error = "";

//if(isset($_REQUEST['enviar'])){
    if(isset($_REQUEST['nombres']) && isset($_REQUEST['telefonos'])){
        $nombreArray = explode(";", $_REQUEST['nombres']);
        $telfArray = explode(";", $_REQUEST['telefonos']);

        // el nombre se pasa a minúsculas (strtolower) y la primera letra de cada palabra a mayúsculas (ucwords)
        $nombre = ucwords(strtolower($_REQUEST['nombre']));
        $telefono = $_REQUEST['telefono'];

        if($nombre == null){
            $error = "NO SE HA INTRODUCIDO EL NOMBRE";
        }else{
            if(in_array($nombre, $nombreArray)){ // si el nombre introducido existe en el array 
                $indice = array_search($nombre, $nombreArray); // obtener la posición del nombre en el array
                
                // si el télefono no está vacío y tiene una longitud de 9
                if(($telefono != null) && (strlen($telefono) == 9)){ 
                    $telfArray[$indice] = $telefono; // modificar el teléfono
                }else{
                    $error = "NO SE HA INTRODUCIDO UN TELÉFONO O NO TIENE LA LONGITUD SUFICIENTE.<br>";
                    $error .= "Eliminando el contacto...";

                    // si está vacío eliminar el registro de cada array
                    unset($nombreArray[$indice]);
                    unset($telfArray[$indice]);
                }
            }else{
                // si no existe el nombre y se registro un teléfono de longitud 9
                if(($telefono != null) && (strlen($telefono) == 9)){
                    if(in_array($telefono,$telfArray)){
                        $error = "El teléfono ya existe en la agenda.";
                    }else{
                        // se añade los valores de nombre y teléfono a sus respectivos array
                        array_push($nombreArray, $nombre);
                        array_push($telfArray, $telefono);
                    }
                }else{
                    $error = "NO SE HA INTRODUCIDO UN TELÉFONO O NO TIENE LA LONGITUD SUFICIENTE";
                }
            }
        }
    }else{
        $error = "Los campos son obligatorios.";
        $nombreArray = array();
        $telfArray = array();
    }
//}

// mostrar la tabla por pantalla
echo "<h1>Agenda telefónica</h1>";
echo "<table border>";
echo "<tr><th>Nombre</th><th>Teléfono</th></tr>";
foreach ($nombreArray as $i => $n) {
    echo "<tr><td>$nombreArray[$i]</td>"; 
    echo "<td>$telfArray[$i]</td></tr>";;
}
echo "<table>"; 


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario para probar datos</title>
    <!-- Preparamos el entorno gráfico para los datos -->
    <!--<script type="text/javascript"
        src="https://me.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=g6Y1jP29lgmvvnVvPR0pxreIMri2Bbqqo1zRZN35J1iT73UyKwU3BWg1R0uVCRAAMcCriZlf8xyvs0tr3O4Psw"
        charset="UTF-8"></script> -->
    <link rel="stylesheet" href="style.css">
</head>
<!-- Comenzamos poniendo el foco del cursor en la pregunta de nombre -->
<!-- <body onload='document.forms.formulario.nombre.focus()'> -->
<body>
    <!-- Creamos una capa en la parte inferior derecha para que no estorben las preguntas -->
    <br><br><br>
    <div class="bajoDch">
        <!-- Creamos un formulario para enviar sus datos por POST a la misma página -->
        <form name="formulario" action = "" method="POST">
            <table style="border: 0px;">
                <tr style="background-color: #8080ff;">Introduzca los datos
                    <!-- Solicitamos el nombre de la persona -->
                    <td>
                        <fieldset>
                            <legend>Nombre</legend>
                            <input name="nombre" type="text" />
                        </fieldset>
                    </td>
                    <td>
                        <fieldset>
                            <legend>Teléfono</legend>
                            <input name="telefono" type="text" />
                        </fieldset>
                    </td>
                </tr>
            </table>
            <input name="nombres" type="hidden" value="<?php echo implode(";",$nombreArray) ?>">
            <input name="telefonos" type="hidden" value="<?php echo implode(";",$telfArray) ?>">
            <input name="enviar" type="submit" value="Enviar">
        </form>
    </div>
    <div>
        <?php echo $error;?>
    </div>
</body>
</html>

