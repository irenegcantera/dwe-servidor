<?php
if(isset($_REQUEST['datosnt'])){
    eval('$ntArray='.$_REQUEST['datosnt'].';');
    // el nombre se pasa a minúsculas y la primera letra de cada palabra a mayúsculas
    $nombre = ucwords(strtolower($_REQUEST['nombre'])); 
    $telefono = $_REQUEST['telefono'];
    if($nombre == null){
        echo "<h4>NO SE HA INTRODUCIDO EL NOMBRE</h4>";
    }else{
        // si el array está vacío y el teléfono tiene una longitud de 9 introducimos el registro 
        if(count($ntArray) == 0){
            if((strlen($telefono) == 9)){
                $ntArray = [$nombre => $telefono]; 
            }else{
                echo "<h4>NO SE HA INTRODUCIDO UN TELÉFONO O NO TIENE LA LONGITUD SUFICIENTE</h4>";
            }
        }else{
            foreach($ntArray as $n => $t){
                if($nombre == $n){
                    // si el télefono no está vacío y tiene una longitud de 9
                    if(($telefono != null) && (strlen($telefono) == 9)){
                        $ntArray[$n] = $telefono; // modificar teléfono si el nombre ya existe
                    }else{
                        echo "<h4>NO SE HA INTRODUCIDO EL TELÉFONO O NO TIENE LA LONGITUD SUFICIENTE</h4>";
                        echo "Se va a eliminar el contacto";
                        // si está vacío eliminar el registro
                        unset($ntArray[$n]); 
                    }
                }else{
                    // si no existe el nombre y se registro un teléfono de longitud 9
                    if(($telefono != null) && (strlen($telefono) == 9)){
                            $ntArray[$nombre] = $telefono; // se añade la clave nombre y el valor teléfono
                    }else{
                        echo "<h4>NO SE HA INTRODUCIDO UN TELÉFONO O NO TIENE LA LONGITUD SUFICIENTE</h4>";
                    }
                }
            }
        }
    }
}else{
    $ntArray = array();
}
// mostrar la tabla por pantalla
echo "<h1>Agenda telefónica</h1>";
echo "<table border>";
echo "<tr><th>Nombre</th><th>Teléfono</th></tr>";
foreach ($ntArray as $n => $t) {
    echo "<tr><td>$n</td><td>$t</td></tr>"; 
}
echo "<table>"; 
?>

<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
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
            <input name="datosnt" type="hidden" value="<?php echo (var_export($ntArray,true)) ?>" />
            <input name="enviar" type="submit" value="Enviar" />
        </form>
    </div>
</body>
</html>

