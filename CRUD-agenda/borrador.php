<?php
$rutaFichero = "./files/contactos.txt";
$fichero = file_get_contents($rutaFichero);  // obtener todo el contenido
$linea_datos = explode("\n",$fichero); // guardar el contenido separado por un salto de línea en un array 

// Eliminar el último índice del array ya que se introduce un espacio en blanco
array_pop($linea_datos); 

$datos = array(); // nuevo array multidimensional
$i = 0; // contador

foreach($linea_datos as $key => $value){
    foreach(explode(';',$value) as $v){
        $datos[$key][$i++] = $v;
    }
}
?>