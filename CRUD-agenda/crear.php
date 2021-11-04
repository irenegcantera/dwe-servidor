<?php 
    include 'components/navbar.php';
    require 'functions.php';

    if(isset($_REQUEST['submit'])){
        if(isset($_REQUEST['nombre']) && isset($_REQUEST['telefono'])){
            $nombre = $_REQUEST['nombre'];
            $telf = $_REQUEST['telefono'];
            if(isset($_REQUEST['guardar'])){
                if(isset($_FILES['foto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK){
                    $foto = $_FILES['foto'];
                }else{
                    $foto = 'none';
                }
            }
            
            // comprobaciones
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