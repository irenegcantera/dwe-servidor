<?php
if (obtainDirectory() == "productos"){
    echo "<fieldset>
        <legend>Código</legend>
        <input name='cod' type= 'text' value='' required>
    </fieldset>
    <fieldset>
        <legend>Nombre</legend>
        <input name='nombre' type= 'text' value=''>
    </fieldset>
    <fieldset>
        <legend>Nombre corto</legend>
        <input name='ncorto' type= 'text' value='' required>
    </fieldset>
    <fieldset>
        <legend>Descripción</legend>
        <textarea name='desc' rows='4' cols='50' value=''></textarea>
    </fieldset>
    <fieldset>
        <legend>Foto</legend>
        <input name='foto' type= 'file' value=''>
    </fieldset>
    <fieldset>
        <legend>PVP</legend>
        <input name='pvp' type= 'text' value='' required>
    </fieldset>
    <fieldset>
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
}
?>