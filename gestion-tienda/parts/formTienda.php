<?php
    if(obtainDirectory() == "tiendas"){
        echo "<fieldset>
            <legend>Nombre</legend>
            <input name='nombre' type= 'text' value='' required>
        </fieldset>
        <fieldset>
            <legend>Teléfono</legend>
            <input name='tlf' type= 'text' value=''>
        </fieldset>";
    }
?>