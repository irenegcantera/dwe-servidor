<?php 
    include 'components/navbar.php';
    require 'functions.php';

    if(isset($_REQUEST['submit'])){
        if(isset($_REQUEST['nombre']) && isset($_REQUEST['telefono'])){
            $nombre = ucwords(strtolower($_REQUEST['nombre'])); // primera lettra en mayúsculas y el resto en minúscula
            $telf = $_REQUEST['telefono'];
            if(isset($_REQUEST['guardar'])){
                if(isset($_FILES['foto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK){
                    $foto = $_FILES['foto'];
                }else{
                    $foto = null;
                    // echo "Ha dado error";
                }
            }else{
                $foto = null;
                // echo "No se ha introducido foto";
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
                        // echo "Se repite el nombre o el teléfono";
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
?>

<form name="formulario" action="crear.php" method="POST" enctype="multipart/form-data">
<table>
    <tr>Introduzca los datos
        <!-- Solicitamos el nombre de la persona -->
        <td>
            <fieldset>
                <legend>Nombre</legend>
                <input name="nombre" type="text" value=""/>

            </fieldset>
        </td>
        <td>
            <fieldset>
                <legend>Teléfono</legend>
                <input name="telefono" type="text" value=""/>
            </fieldset>
        </td>
        <td>
            <fieldset>
                <legend>Foto</legend>
                <input name="foto" type="file" />
            </fieldset>
        </td>
    </tr>
</table>
<input name='guardar' type='hidden' value='<?php echo $guardado;?>'/>
<input name='submit' type="submit" value="Crear contacto"/>
</form>

<?php include 'components/footer.php';?>