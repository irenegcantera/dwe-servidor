<?php
  require '../functions.php';
?>
<br><br><br>
<link rel = "stylesheet" type = "text/css" href = <?=PATH."css/form.css"?>>
<form name="formulario" action="" method="POST" enctype="multipart/form-data">
<p>Introduce los siguientes datos:</p>     
<?php

  include 'formProducto.php';
  include 'formFamilia.php';
  include 'formTienda.php';

?>
<br>
<input name='guardar' type='hidden' value=''/>
<input name='submit' type='submit' value='Crear contacto'>

</form>