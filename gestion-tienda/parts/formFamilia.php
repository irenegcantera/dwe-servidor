<?php
    if(obtainDirectory() == "familias"){
        echo "<fieldset>
            <legend>Código</legend>
            <input name='cod' type= 'text' value='' required>
        </fieldset>
        <fieldset>
            <legend>Nombre</legend>
            <input name='nombre' type= 'text' value='' required>
        </fieldset>";
    }
?>