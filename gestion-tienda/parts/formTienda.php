<?php
    if(obtainDirectory() == "tiendas"){
        if(isset($_REQUEST['editar']) && $_REQUEST['editar'] == true){
            $cod = $_REQUEST['cod'];
            $db = connection(); // abrir conexión
            if($db != null){
                $consulta = $db -> query("SELECT * FROM tienda WHERE cod = '$cod'", PDO::FETCH_OBJ);  
                while($row = $consulta -> fetch()){
                    $nombre = $row -> nombre;
                    $tlf = $row -> tlf;
                }
            }
            // cerrar conexión e instancias
            $consulta = null;
            $row = null;
            $db = null;

            echo "<fieldset>
                <legend>Nombre</legend>
                <input name='nombre' type= 'text' value='$nombre' required>
            </fieldset>
            <fieldset>
                <legend>Teléfono</legend>
                <input name='tlf' type= 'text' value='$tlf'>
            </fieldset>";
        }else{
            echo "<fieldset>
                <legend>Nombre</legend>
                <input name='nombre' type= 'text' value='' required>
            </fieldset>
            <fieldset>
                <legend>Teléfono</legend>
                <input name='tlf' type= 'text' value=''>
            </fieldset>";
        }
    }
?>