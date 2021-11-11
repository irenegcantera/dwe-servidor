<link rel = "stylesheet" type = "text/css" href = "../css/form.css">
<form name="formulario" action="crear.php" method="GET" enctype="multipart/form-data">
<table>
    <tr>Introduzca los datos
        <!-- Solicitamos el nombre de la persona -->
        <td>
            <fieldset>
                <legend>Nombre</legend>
                <input name='nombre' type= 'text' value=''>
            </fieldset>
        </td
        <td>
            <fieldset>
                <legend>Teléfono</legend>
                <input name='telefono' type= 'text' value=''>
            </fieldset>
        </td>
        <td>
            <fieldset>
                <legend>Foto</legend>
                <!-- accept solo muestra esos formatos de archivo a la hora de subirlos -->
                <input name="foto" type="file" accept=".jpeg, .jpg">
            </fieldset>
        </td>
    </tr>
</table>

<input name='guardar' type='hidden' value=''/>
<input name='submit' type='submit' value='Crear contacto'>

</form>