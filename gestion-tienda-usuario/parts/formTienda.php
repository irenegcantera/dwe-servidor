<br><br><br>
<form name="formulario" action="crear.php" method="POST" enctype="multipart/form-data">  

<?php
require '../functions.php';

if(obtainDirectory() == "tiendas"){
    if(!empty($_REQUEST['editar'])){ 
        if($_REQUEST['editar'] == true){
            $db = connection(); // abrir conexión
            if($db != null){
                $consulta = $db -> query("SELECT * FROM tienda WHERE cod = '".$_REQUEST['cod']."'", PDO::FETCH_OBJ);  
                while($row = $consulta -> fetch()){
                    $nombre = $row -> nombre;
                    $tlf = $row -> tlf;
                }
            }
            
            echo "<h2>TIENDA <i>'".$nombre."'</i> A EDITAR</h2><br>
                <p>Introduce los datos que se vayan a modificar:</p>
                <fieldset>
                    <legend>Nombre</legend>
                    <input name='nombre' type= 'text' value='".$nombre."' required>
                </fieldset>
                <fieldset>
                    <legend>Teléfono</legend>
                    <input name='tlf' type= 'text' value='".$tlf."'>
                </fieldset>
                <input name='cod' type= 'hidden' value='".$_REQUEST['cod']."'>
                <br><input name='guardar' type='submit' value='Guardar cambios'>
                <br><br><a href = 'listar.php'>Volver a Listar</a>";

            // cerrar conexión e instancias
            disconnection($consulta,$row,$db);
        }
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
            <br><input name='submit' type='submit' value='Crear contacto'>
            <br><br><a href = 'listar.php'>Volver a Listar</a>";
    }
}
?>