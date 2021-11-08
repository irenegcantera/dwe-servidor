<?php
// ESTO ES UN BORRADOR PARA IR HACIENDO PRUEBAS
// Otra forma de obtener los datos y cargarlo en un array
// $fichero = "datos.txt";
// $contactos = array();
// if(file_exists($fichero)){ // primero comprobamos que existe
//     $fd = fopen($fichero,"r"); // abrimos el fichero en forma de lectura
//     while(!feof($fd)){ // mientras no se llegue al final
//         $contacto = fgets($fd);  // obtener la primera línea del fichero
//         $contactos[] = explode(";",$contacto); // guardar esa línea en el array
//     }
//     fclose($fd);
// }

$rutaFichero = "./files/contactos.txt";
$fichero = file_get_contents($rutaFichero);  // obtener todo el contenido
$linea_datos = explode("\n",$fichero); // guardar el contenido separado por un salto de línea en un array 
// Eliminar el último índice del array ya que se introduce un espacio en blanco
array_pop($linea_datos); 

$datos = array(); // nuevo array bidimensional
$i = 0; // contador

foreach($linea_datos as $key => $value){
    foreach(explode(';',$value) as $v){
        $datos[$key][] = $v;
    }
}

var_dump($datos);

//     $nombre = "Mireia";
    
//     foreach($datos as $key => $value){
//         foreach($value as $k => $v){
//             if($v == $nombre){
//                 array_splice($datos, $key, 1);
//                 $ruta = $value[2];
//                 unlink($ruta);
//                 //echo "Se ha borrado";
//             }
//         }
//     }
//     // Reindexar las posiciones de los valores
//     $datosActualizados = array();
//     $i = 0;
//     foreach($datos as $key => $value){
//         foreach($value as $k => $v){
//             $datosActualizados[$key][$i++] = $v;
//         }
//     }
        
        

// var_dump($datosActualizados);

    //unlink($rutaFichero); // ELIMINar fichero
    // $indice = 2; // indice que sirve para mostrar la imagen en la tabla
    // foreach($datosActualizados as $key => $value){
    //     foreach($value as $k => $v){
    //         if ($k != $indice){
    //             file_put_contents($rutaFichero, $v.";", FILE_APPEND);
    //         }else{
    //             file_put_contents($rutaFichero, $v, FILE_APPEND); // para que no se sobreescriba
    //         }
    //     }   
    //     file_put_contents($rutaFichero, "\n", FILE_APPEND);
    //     $indice +=3; // se suma 3 posiciones para la siguiente clave
    // }
//var_dump($datos);

?>