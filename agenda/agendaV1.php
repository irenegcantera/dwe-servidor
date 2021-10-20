<?php
if(isset($_REQUEST['datosn']) && isset($_REQUEST['datost'])){
    $nombreArray = explode(";", $_REQUEST['datosn']);
    $telfArray = explode(";", $_REQUEST['datost']);
    $nombre = ucwords(strtolower($_REQUEST['nombre']));
    $telefono = $_REQUEST['telefono'];
    if($nombre == null && $telefono == null){
        echo "<h4>NO SE HA INTRODUCIDO EL NOMBRE O EL TELÉFONO</h4>";
    }else{
        if(in_array($nombre, $nombreArray)){
            $indice = array_search($nombre, $nombreArray);
            if(($telefono != null) && (strlen($telefono) == 9)){
                $telfArray[$indice] = $telefono;
            }else{
                unset($nombreArray[$indice]);
                unset($telfArray[$indice]);
            }
        }else{
            if(($telefono != null) && (strlen($telefono) == 9)){
                array_push($nombreArray, $nombre);
                array_push($telfArray, $telefono);
            }
        }
    }
}else{
    if (isset($_REQUEST['enviar'])){
        echo "NO SE HA INTRODUCIDO NADA.";
    }else{
        $nombreArray = array();
        $telfArray = array(); 
    }
}

echo "<h1>Nombres</h1>";
echo "<table border>";
echo "<tr><th>Nombre</th><th>Teléfono</th></tr>";
for($i = 0; $i < count($nombreArray); $i++){
    echo "<tr><td>$nombreArray[$i]</td><td>$telfArray[$i]</td></tr>"; 
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
    <style type="text/css">
        div {
            padding: 10px 20px;
        }

        h1 {
            font-family: sans-serif;
            font-style: italic;
            text-transform: capitalize;
            color: #008000;
        }

        h4{
            font-family: sans-serif;
            text-transform: capitalize;
            color: red;
        }

        .bajoDch {
            float: right;
            position: absolute;
            margin-right: 0px;
            margin-bottom: 0px;
            bottom: 0px;
            right: 0px;
        }

        .altoDch1 {
            color: #00f;
            float: right;
            position: absolute;
            margin-right: 0px;
            margin-top: 0px;
            top: 0px;
            right: 0px;
        }

        .altoDch2 {
            color: #f00;
            float: right;
            position: absolute;
            margin-right: 0px;
            margin-top: 0px;
            top: 0px;
            right: 0px;
        }
    </style>
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
            <input name="datosn" type="hidden" value="<?php echo implode(";",$nombreArray) ?>" />
            <input name="datost" type="hidden" value="<?php echo implode(";",$telfArray) ?>" />
            <input name="enviar" type="submit" value="Enviar" />
        </form>
    </div>
</body>
</html>

