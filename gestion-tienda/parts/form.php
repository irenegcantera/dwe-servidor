<?php
    require '../functions.php';
?>
<br><br><br>
<link rel = "stylesheet" type = "text/css" href = <?=PATH."css/form.css"?>>
<form name="formulario" action="" method="POST" enctype="multipart/form-data">
<p>Introduce los siguientes datos:</p>
<table>
    <tr>
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
                      </fieldset></td>
                      </tr>";
                echo "<tr><td><fieldset>
                        <legend>Descripción</legend>
                        <textarea name='desc' rows='4' cols='50' value=''></textarea>
                      </fieldset></td>";
                echo "<td><fieldset>
                        <legend>Foto</legend>
                        <input name='foto' type= 'file' value=''>
                      </fieldset></td></tr>";
                echo "<td><fieldset>
                        <legend>PVP</legend>
                        <input name='pvp' type= 'text' value='' required>
                      </fieldset></td>";
                echo "<td><fieldset>
                       <legend>Familia</legend>";

                    $db = connection();
                    if($db != null){
                        $consulta = $db -> query("SELECT * FROM familia ORDER BY nombre", PDO::FETCH_OBJ);
                        echo "<select name='familia' >";
                        while($row = $consulta -> fetch()){
                            echo "<option value=".$row->cod." ".($row->cod=='SAI'?'selected':'').">".$row->nombre."</option>";
                        }
                        echo "</select>";
                        echo "</fieldset></td>";
                    } 
                    $consulta = null;
                    $row = null;
                    $db = null;
            }else if($directory == "tiendas"){
                echo "<td><fieldset>
                        <legend>Teléfono</legend>
                        <input name='tlf' type= 'text' value='' required>
                      </fieldset></td>";

            }
        ?>
    </tr>
</table>
<br>
<input name='guardar' type='hidden' value=''/>
<input name='submit' type='submit' value='Crear contacto'>

</form>