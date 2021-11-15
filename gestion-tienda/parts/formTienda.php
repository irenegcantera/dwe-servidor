<br><br><br>
<form name="formulario" action="crear.php" method="POST" enctype="multipart/form-data">  

<?php
require '../functions.php';

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

        echo "<h2>TIENDA <i>'$cod'</i> A EDITAR</h2><br>
            <p>Introduce los datos que se vayan a modificar:</p><fieldset>
                <legend>Nombre</legend>
                <input name='nombre' type= 'text' value='$nombre' required>
            </fieldset>
            <fieldset>
                <legend>Teléfono</legend>
                <input name='tlf' type= 'text' value='$tlf'>
            </fieldset>
            <br><input name='guardar' type='submit' value='Guardar cambios'>";
    }else{
        echo "<p>Introduce los siguientes datos:</p>
            <fieldset>
                <legend>Nombre</legend>
                <input name='nombre' type= 'text' value='' required>
            </fieldset>
            <fieldset>
                <legend>Teléfono</legend>
                <input name='tlf' type= 'text' value=''>
            </fieldset>
            <br><input name='submit' type='submit' value='Crear contacto'>";
    }
}
?>