<?php
require_once("conf.inc"); // cargar fichero de configuración

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

    // $rutaFichero = "./files/contactos.txt"; // ruta Fichero
    // Si existe se introducirá el nombre y telefono, sino existe se creará y se introducirá
    file_put_contents(FICHERO, $nombre.";".$telf.";".$rutaFoto, FILE_APPEND); // para que no sobreescriba
    file_put_contents(FICHERO, "\n", FILE_APPEND);
}


/* Función que lee el fichero y recupera la información guardandola en un array */
function getContactos(){
    // $rutaFichero = "./files/contactos.txt";
    $fichero = file_get_contents(FICHERO);  // obtener todo el contenido
    $linea_datos = explode("\n",$fichero); // guardar el contenido separado por un salto de línea en un array 
    // Eliminar el último índice del array ya que se introduce un espacio en blanco
    array_pop($linea_datos); 

    $datos = array(); // nuevo array bidimensional
    $i = 0; // contador

    foreach($linea_datos as $key => $value){
        foreach(explode(';',$value) as $v){
            $datos[$key][$i++] = $v;
        }
    }

    return $datos;
}

/* Función que muestra la tabla */
function showContactos($datos){
    echo "<br><table>
            <tr>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Foto</th>
                <th>Operaciones</th>
            </tr>";
    
    $indice = 2; // indice que sirve para mostrar la imagen en la tabla
    $indNombre = 0; // indice para el nombre
    $indTelf = 1; // indice para el teléfono
    foreach($datos as $key => $value){
        echo "<tr>";
        foreach($value as $k => $v){
            if ($k != $indice){ // si la clave es igual al índice, se imprime la imagen
                echo "<td>$v</td>";
            }else{
                echo "<td><img src='$v' style = 'width:25%'></td>";
            }
        }

        echo "<td><a href = crear.php?editar=true&nombre=".$datos[$key][$indNombre]."&telf=".$datos[$key][$indTelf].">Editar</a><a>Eliminar</a></td>"; // mostrar enlaces de Editar y Eliminar
        echo "</tr>";
        $indice +=3; // se suma 3 posiciones para la siguiente clave
        $indNombre +=3; // se suma 3 posiciones 
        $indTelf +=3; // se suma 3 posiciones 
    }
    echo "</table><br>";
}

// deleteContacto($nombre). Elimina el contacto cuyo nombre coincida con el parámetro.
// updateContacto($nomAnt,$nombre,$telefono,$foto). Actualiza el contacto cuyo nombre coincida con $nomAnt con los nuevos datos. También puedes eliminar y añadir.
?>