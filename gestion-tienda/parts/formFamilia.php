<?php
    if(obtainDirectory() == "familias"){
        if(isset($_REQUEST['editar']) && $_REQUEST['editar'] == true){
            $cod = $_REQUEST['cod'];
            $db = connection(); // abrir conexión
            if($db != null){
                $consulta = $db -> query("SELECT * FROM familia WHERE cod = '$cod'", PDO::FETCH_OBJ);  
                while($row = $consulta -> fetch()){
                    $nombre = $row -> nombre;
                }
            }
            // cerrar conexión e instancias
            $consulta = null;
            $row = null;
            $db = null;

            echo "<fieldset>
                <legend>Código</legend>
                <input name='cod' type= 'text' value='$cod' required>
            </fieldset>
            <fieldset>
                <legend>Nombre</legend>
                <input name='nombre' type= 'text' value='$nombre' required>
            </fieldset>";
        }else{
            echo "<fieldset>
                <legend>Código</legend>
                <input name='cod' type= 'text' value='' required>
            </fieldset>
            <fieldset>
                <legend>Nombre</legend>
                <input name='nombre' type= 'text' value='' required>
            </fieldset>";
        }
    }
?>