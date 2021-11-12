<?php
    require '../functions.php';
?>

<link rel = "stylesheet" type = "text/css" href = "css/form.css">

<form name="formulario" action="crear.php" method="POST" enctype="multipart/form-data">
<table>
    <tr>Introduzca los datos
    <td><fieldset>
        <legend>Código</legend>
        <input name='cod' type= 'text' value='' required>
    </fieldset></td>
    <td><fieldset>
        <legend>Nombre</legend>
        <input name='nombre' type= 'text' value=''>
    </fieldset></td>
        <?php
            $directory = obtainDirectory();
            if($directory == "productos"){
                echo "<td><fieldset>
                        <legend>Nombre corto</legend>
                        <input name='ncorto' type= 'text' value='' required>
                      </fieldset></td>";
                echo "<td><fieldset>
                        <legend>Descripción</legend>
                        <input name='desc' type= 'textarea' value=''>
                      </fieldset></td>";
                echo "<td><fieldset>
                        <legend>Foto</legend>
                        <input name='foto' type= 'file' value=''>
                      </fieldset></td>";
                echo "<td><fieldset>
                        <legend>PVP</legend>
                        <input name='cod' type= 'text' value='' required>
                      </fieldset></td>";
                echo "<td><fieldset>
                       <legend>Familia</legend>";

                    $db = connection();
                    if($db != null){
                        $consulta = $db -> query("SELECT * FROM familias ORDER BY nombre", PDO::FETCH_OBJ);
                        echo "<select name='familia' >";
                        while($row = $consulta -> fetch()){
                            echo "<option value='".$row->cod."' ". ($row->cod=='HDD'?'selected':'').">".$row->nombre."</option>";
                        }
                        echo "</select>";
                        echo "</fieldset></td>";
                    } 
                    $db = null;
            }else if($directory == "tiendas"){
                echo "<td><fieldset>
                        <legend>Teléfono</legend>
                        <input name='tlf' type= 'text' value='' required>
                      </fieldset></td>";

            }
        ?>

        <td>
            <fieldset>
                <legend>Teléfono</legend>
                <input name='telefono' type= 'text' value=''>
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

<input name='guardar' type='hidden' value=''/>
<input name='submit' type='submit' value='Crear contacto'>

</form>