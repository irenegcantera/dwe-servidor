<br><br><br>
<form name="formulario" action="crear.php" method="POST" enctype="multipart/form-data">  

<?php
require '../functions.php';

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
        
        echo "<h2>FAMILIA <i>'$cod'</i> A EDITAR</h2><br>
            <p>Introduce los datos que se vayan a modificar:</p>
            <fieldset>
                <legend>Nombre</legend>
                <input name='nombre' type= 'text' value='$nombre' required>
            </fieldset>
            <input name='cod' type= 'hidden' value='".$_REQUEST['cod']."'>
            <br><input name='guardar' type='submit' value='Guardar cambios'>
            <br><br><a href = 'listar.php'>Volver a Listar</a>";

            // cerrar conexión e instancias
            disconnection($consulta,$row,$db);
    }else{
        echo "<p>Introduce los siguientes datos:</p>
            <fieldset>
                <legend>Código</legend>
                <input name='cod' type= 'text' value='' required>
            </fieldset>
            <fieldset>
                <legend>Nombre</legend>
                <input name='nombre' type= 'text' value='' required>
            </fieldset>
            <br><input name='submit' type='submit' value='Crear contacto'>
            <br><br><a href = 'listar.php'>Volver a Listar</a>";
            
    }
}
?>