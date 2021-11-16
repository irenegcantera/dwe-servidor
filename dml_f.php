<?php
    //ELIMINAR,INSERT Y ACTUALIZAR UN REGISTRO USANDO MySQLi con FUNCIONES
    //Conecta a la base de datos dwes y muestra información
  

    $bd = mysqli_connect("localhost","dwes","abc123.","dwes");
    if (!$bd) {
       print "Ha habido un error al conectar a la BBDD<br>";
       echo  "Número de error: ".mysqli_connect_errno()."<br>";
       echo "Error: " . mysqli_connect_error() ."<br>";
       exit;
    }  
    
    $cod = "MON";
    $tipo = "Monitores";
    $resultado=mysqli_query($bd,"INSERT INTO familia VALUES ('$cod','$tipo')");
    echo ($resultado)?"Se han insertado ".mysqli_affected_rows($bd) ." registros<br>":mysqli_error($bd);
   //  $resultado=mysqli_query($bd,"UPDATE familia SET nombre='Monitores y pantallas' WHERE cod='MON'");
   //  echo ($resultado)?"Se han actualizado ".mysqli_affected_rows($bd) ." registros<br>":mysqli_error($bd);
   //  $resultado=mysqli_query($bd,"DELETE FROM familia WHERE cod='MON'");
   //  echo ($resultado)?"Se han eliminado ".mysqli_affected_rows($bd) ." registros<br>":mysqli_error($bd);
 
    mysqli_close($bd);