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
    <link rel="stylesheet" href="../style.css">
</head>
<!-- Comenzamos poniendo el foco del cursor en la pregunta de nombre -->
<!-- <body onload='document.forms.formulario.nombre.focus()'> -->
<body>
    <!-- mostrar la tabla por pantalla -->
    <h1>Agenda telefónica</h1>
    <?php
        include 'checksV1.php';
    ?>
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
    <div id = "error">
        <?php echo $error;?>
    </div>
</body>
</html>

