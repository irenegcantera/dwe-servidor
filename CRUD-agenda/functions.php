<?php
// función que almacena los nombre y teléfonos en un fichero
// y la foto en una subcarpeta
function addContactos($nombre,$telf,$foto) {
    // mover la foto al directorio photos
    $temporal = $foto['tmp_name'];
    $partes = explode(".", $foto['name']);
    $extension= strtolower(end($partes));
    $rutaFoto = "./files/photos/".$nombre.".".$extension;
    if (move_uploaded_file($temporal,$rutaFoto)){ // ruta anterior, ruta nueva
        // echo "Fichero subido correctamente.";
    }else{
        // echo "Ha ocurrido un error.";
    }

    $rutaFichero = "./files/contactos.txt"; // ruta Fichero
    // Si existe se introducirá el nombre y telefono, sino existe se creará y se introducirá
    file_put_contents($rutaFichero, $nombre.";".$telf.";".$nombre.".".$extension, FILE_APPEND); // para que no sobreescriba
    file_put_contents($rutaFichero, "\n", FILE_APPEND);

}


/* Función que lee el fichero y recupera la información guardandola en un array */
function getContactos(){
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

    return $datos;
}

// deleteContacto($nombre). Elimina el contacto cuyo nombre coincida con el parámetro.
// updateContacto($nomAnt,$nombre,$telefono,$foto). Actualiza el contacto cuyo nombre coincida con $nomAnt con los nuevos datos. También puedes eliminar y añadir.
?>