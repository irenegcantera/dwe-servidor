<?php
    include 'components/navbar.php';
    require 'functions.php';

    $message = "";
    // CREAR CONTACTO
    if(isset($_REQUEST['submitCrear'])){
        if(!empty($_REQUEST['nombre']) && !empty($_REQUEST['telefono'])){
            $nombre = ucwords(strtolower($_REQUEST['nombre'])); // primera letra en mayúsculas y el resto en minúscula
            $telf = $_REQUEST['telefono'];

            if(isset($_FILES['foto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK){
                $foto = $_FILES['foto'];
            }else{
                $foto = null;
                $message = "Error al subir el archivo: '".errorMessage($_FILES['foto']['error'])."'";
            }

            $datos = getContactos();

            // ES OBLIGATORIO SUBIR UNA FOTO
            if ($foto != null){
                if (count($datos) == 0){ // empty($datos)
                    addContactos($nombre,$telf,$foto);
                    $message = "Nuevo contacto añadido.";
                }else{
                    // Recorremos el array y comprobamos que el nombre ni el teléfono introducido no está ya en el fichero
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
                        $message = "Nuevo contacto añadido.";
                    }else{
                        $message = "Error al crear el contacto. Recuerde que el <span>nombre NO</span> debe existir.";
                    }
                }
            }
        }else{
            $message = "HAY QUE RELLENAR TODOS LOS CAMPOS";
        }
    }

    // EDITAR NOMBRE
    if (isset($_REQUEST['submitEditar'])){
        $nomAnt = $_REQUEST['nomAnt'];
        $telfAnt = $_REQUEST['telfAnt'];
        $nombre = ucwords(strtolower($_REQUEST['nombre']));
        $telefono = $_REQUEST['telefono'];

        $datos = getContactos();

        foreach($datos as $key => $value){
            foreach($value as $k => $v){
                if($v == $telfAnt){
                    $foto = $value[2]; // recupera la ruta de la foto
                }
            }
        }

        updateContacto($nomAnt,$telfAnt,$nombre,$telefono,$foto);
        //redirección a listar.php 
        header("Location: listar.php");
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
                <!-- accept solo muestra esos formatos de archivo a la hora de subirlos -->
                <input name="foto" type="file" accept=".jpeg, .jpg">
            </fieldset>
        </td>
    </tr>
</table>

<?php
if(isset($_REQUEST['editar'])){
    echo "<input name='nomAnt' type ='hidden' value=".$_REQUEST['nombre'].">";
    echo "<input name='telfAnt' type ='hidden' value=".$_REQUEST['telefono'].">";
    echo "<br>";
    echo "<input name='submitEditar' type='submit' value='Guardar contacto'>";
}else{
    echo "<input name='guardar' type='hidden' value=''/>";
    echo "<br>";
    echo "<input name='submitCrear' type='submit' value='Crear contacto'>";
}
?>

</form>
<div>
    <?php echo $message; ?>
</div>

<?php 
include 'components/footer.php';
?>