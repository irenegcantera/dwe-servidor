<?php
    include 'components/navbar.php';
    require 'functions.php';

    if(isset($_REQUEST['submitCrear'])){
        if(isset($_REQUEST['nombre']) && isset($_REQUEST['telefono'])){
            $nombre = ucwords(strtolower($_REQUEST['nombre'])); // primera lettra en mayúsculas y el resto en minúscula
            $telf = $_REQUEST['telefono'];
            if(isset($_FILES['foto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK){
                $foto = $_FILES['foto'];
            }else{
                $foto = null;
                echo "<p>Error al subir el archivo.</p>";
            }

            // Comprobaciones
            $datos = getContactos();
            if ($foto != null){
                if (count($datos) == 0){
                    addContactos($nombre,$telf,$foto);
                }else{
                    // Recorremos el array y comprobamos que el nombre introducido no está ya en el fichero
                    // Contadores que cuentan las veces que aparece el nombre y el teléfono
                    $numNombres = 0;
                    $numTelefonos = 0;
                    foreach ($datos as $key => $value) {
                        foreach($value as $v){
                            if ($nombre == $v){
                                $numNombres++;
                            }
                            if ($telf == $v){
                                $numTelefonos++;
                            }
                        }
                    }
                    // Si no ha aparecido el nombre ni el teléfono, añadimos el contacto al fichero
                    if (($numNombres == 0) && ($numTelefonos == 0)) {
                        addContactos($nombre,$telf,$foto);
                    }else{
                        echo "<p>Error al crear el contacto. Recuerde que el <span>nombre NO</span> debe existir.</p>";
                    }
                }
            }else{
                // echo "Se debe subir una foto";
            }
        }else{
            // echo "Hay que rellenar todos los campos.";
        }
    }else{
        // echo "No se ha enviado información al servidor.";
    }

    // EDITAR NOMBRE
    if (isset($_REQUEST['submitEditar'])){
        // echo "paso por aquí";
        $nomAnt = $_REQUEST['nomAnt'];
        $nombre = $_REQUEST['nombre'];
        $datos = getContactos();
        foreach($datos as $key => $value){
            foreach($value as $k => $v){
                if($v == $nomAnt){
                    $telf = $value[1];
                    $foto = $value[2];
                }
            }
        }
        updateContacto($nomAnt,$nombre,$telf,$foto);
        //redirección a listar.php sin formato
        //header("Location: listar.php/");
    }

?>

<form name="formulario" action="crear.php" method="POST" enctype="multipart/form-data">
<table>
    <tr>Introduzca los datos
        <!-- Solicitamos el nombre de la persona -->
        <td>
            <fieldset>
                <legend>Nombre</legend>
                <?php
                    if (isset($_REQUEST['editar']) && $_REQUEST['editar'] == true){
                        echo "<input name='nombre' type='text' value=".$_REQUEST['nombre'].">";
                    }else{
                        echo "<input name='nombre' type= 'text' value=''>";
                    }
                ?>
            </fieldset>
        </td>
        <td>
            <fieldset>
                <legend>Teléfono</legend>
                <?php
                    if (isset($_REQUEST['editar']) && $_REQUEST['editar'] == true){
                        echo "<input name='telefono' type='text' value=".$_REQUEST['telefono'].">";
                    }else{
                        echo "<input name='telefono' type= 'text' value=''>";
                    }
                ?>
            </fieldset>
        </td>
        <td>
            <fieldset>
                <legend>Foto</legend>
                <input name="foto" type="file" accept=".jpeg, .jpg">
            </fieldset>
        </td>
    </tr>
</table>
<input name='guardar' type='hidden' value=''/>

<?php
if(isset($_REQUEST['editar'])){
    echo "<input name='nomAnt' type ='hidden' value=".$_REQUEST['nombre'].">";
    echo "<br>";
    echo "<input name='submitEditar' type='submit' value='Guardar contacto' onclick='location.href('listar.php')'>";
}else{
    echo "<input name='guardar' type='hidden' value=''/>";
    echo "<br>";
    echo "<input name='submitCrear' type='submit' value='Crear contacto'>";
}
?>

</form>

<?php include 'components/footer.php';?>