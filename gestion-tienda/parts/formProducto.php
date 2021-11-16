<form name="formulario" action="crear.php" method="POST" enctype="multipart/form-data">  

<?php
require '../functions.php';

if (obtainDirectory() == "productos"){
    if(isset($_REQUEST['editar']) && $_REQUEST['editar'] == true){
        $cod = $_REQUEST['cod'];
        $db = connection(); // abrir conexión
        if($db != null){
            $consulta = $db -> query("SELECT * FROM producto WHERE cod = '$cod'", PDO::FETCH_OBJ);  
            while($row = $consulta -> fetch()){
                $nombre = $row -> nombre;
                $ncorto = $row -> nombre_corto;
                $desc = $row -> descripcion;
                $foto = $row -> foto;
                $pvp = $row -> PVP;
                $fam = $row -> familia;
            }
        }
        // cerrar conexión e instancias
        $consulta = null;
        $row = null;
        $db = null;

        echo "<h2>PRODUCTO <i>'$cod'</i> A EDITAR</h2><br>
            <p>Introduce los datos que se vayan a modificar:</p>
            <fieldset>
                <legend>Nombre</legend>
                <input name='nombre' type= 'text' value='$nombre'>
            </fieldset>
            <fieldset>
                <legend>Nombre corto</legend>
                <input name='ncorto' type= 'text' value='$ncorto' required>
            </fieldset>
            <fieldset>
                <legend>Descripción</legend>
                <textarea name='desc' rows='15' cols='100' value=''>$desc</textarea>
            </fieldset>
            <fieldset>
                <legend>Foto</legend>
                <input name='foto' type= 'file' value='$foto'>
            </fieldset>
            <fieldset>
                <legend>PVP</legend>
                <input name='pvp' type= 'text' value='$pvp' required>
            </fieldset>
            <fieldset>
                <legend>Familia</legend>";

        $db = connection(); // abrir conexión
        if($db != null){
            $consulta = $db -> query("SELECT * FROM familia ORDER BY nombre", PDO::FETCH_OBJ);
            echo "<select name='familia' >";
            while($row = $consulta -> fetch()){
                echo "<option value=".$row -> cod." ".($row -> cod == $fam ?'selected':'').">".$row -> nombre."</option>";
            }
            echo "</select>";
            echo "</fieldset>";
        }
        // cerrar conexión e instancias
        $consulta = null;
        $row = null;
        $db = null;
        echo "<br><input name='guardar' type='submit' value='Guardar cambios'>";
    }else{
        echo "<p>Introduce los siguientes datos:</p>
            <fieldset>
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
                <textarea name='desc' rows='15' cols='100' value=''></textarea>
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
            echo "</fieldset>";
        }
        $consulta = null;
        $row = null;
        $db = null;

        echo "<br><input name='submit' type='submit' value='Crear contacto'>";
    }
}
?>