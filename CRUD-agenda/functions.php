<?php
require_once("conf.inc"); // cargar fichero de configuración

/* Función que almacena el nombre, teléfono y la ruta de la foto en el fichero. Además, la foto se guarda en una subcarpeta */
function addContactos($nombre,$telf,$foto) {
    // mover la foto al directorio photos
    $temporal = $foto['tmp_name'];
    $partes = explode(".", $foto['name']);
    $extension= strtolower(end($partes));
    $rutaFoto = "./files/photos/".$nombre.".".$extension;
    move_uploaded_file($temporal,$rutaFoto); // ruta anterior, ruta nueva

    // Si existe se introducirá el nombre y telefono, sino existe se creará y se introducirá
    file_put_contents(FICHERO, $nombre.";".$telf.";".$rutaFoto, FILE_APPEND); // para que no sobreescriba
    file_put_contents(FICHERO, "\n", FILE_APPEND);
}

/* Función que lee el fichero y recupera la información guardandola en un array */
function getContactos(){
    if (file_exists(FICHERO)){
        $fichero = file_get_contents(FICHERO);  // obtener todo el contenido
        $linea_datos = explode("\n",$fichero); // guardar el contenido separado por un salto de línea en un array 
        // Eliminar el último índice del array ya que se introduce un espacio en blanco
        array_pop($linea_datos); 

        $datos = array(); // nuevo array bidimensional
        
        foreach($linea_datos as $key => $value){
            foreach(explode(';',$value) as $v){
                $datos[$key][] = $v;
            }
        }
        return $datos;
    }else{ // si no existe el fichero se creará
        $fichero = fopen("./files/contactos.txt","w");
        fclose($fichero);
    }
}

/* Función que muestra una tabla con los datos del contacto y las operaciones de Editar y Eliminar */
function showContactos($datos){
    if(!empty($datos)){
        echo "<br><table>
            <tr>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Foto</th>
                <th>Operaciones</th>
            </tr>";
    
        foreach($datos as $key => $value){
            echo "<tr>";
            foreach($value as $k => $v){
                if ($k != 2){ 
                    echo "<td>$v</td>";
                }else{ // si la clave es igual a la posición de la imagen, que es 2, se imprimirá
                    echo "<td><img src='$v' style = 'width:25%'></td>";
                }
            }
            // 0 es la posición del nombre y 1 del teléfono
            echo "<td><a href = crear.php?editar=true&nombre=".$datos[$key][0]."&telefono=".$datos[$key][1].">Editar</a>
                    <br><br>
                    <a href = listar.php?nombre=".$datos[$key][0].">Eliminar</a></td>"; // mostrar enlaces de Editar y Eliminar
            echo "</tr>";
        }
        echo "</table><br>";
    }else{
        echo "<p>NO HAY NINGÚN CONTACTO EN LA AGENDA</p>";
    }
}

/* Función que almacena de nuevo en el fichero los datos modificados */
function saveContactos($datos){
    unlink(FICHERO); // elimina el fichero
    foreach($datos as $key => $value){
        foreach($value as $k => $v){
            if ($k != 2){
                file_put_contents(FICHERO, $v.";", FILE_APPEND);
            }else{
                file_put_contents(FICHERO, $v, FILE_APPEND); // para que no se sobreescriba
            }
             
        }   
        file_put_contents(FICHERO, "\n", FILE_APPEND);
    }
}

/* Función que elimina el contacto cuyo nombre coincida con el parámetro.*/
function deleteContacto($nombre){
    $datos = getContactos();
    foreach($datos as $key => $value){
        foreach($value as $k => $v){
            if($v == $nombre){ // si el valor conincide con el parámetro
                array_splice($datos, $key, 1); // elimina la clave del array de datos
                $ruta = $value[2];
                unlink($ruta); // elimina la foto con el nombre del parámetro
            }
        }
    }        
    saveContactos($datos); // guarda los datos
}

/* Función que actualiza SOLO el nombre y/o teléfono del contacto */
function updateContacto($nomAnt,$telfAnt,$nombre,$telefono,$foto){
    $datos = getContactos();
    foreach($datos as $key => $value){
        foreach($value as $k => $v){
            if($v == $telfAnt){
                $datos[$key][0] = $nombre;
                $datos[$key][1] = $telefono;
                // renombramos la foto del directorio con el nuevo nombre
                rename($foto,"./files/photos/".$nombre.".jpg");
                // cambiamos el nombre a la foto del array de datos también
                $datos[$key][2] = "./files/photos/".$nombre.".jpg";
            }
        }
    }
    saveContactos($datos);
}


function errorMessage($error){
    switch($error){
        case UPLOAD_ERR_INI_SIZE:
            $message = "The uploaded file exceeds the upload_max_filesize directive in php.ini";
            break;
        case UPLOAD_ERR_FORM_SIZE:
            $message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form";
            break;
        case UPLOAD_ERR_PARTIAL:
            $message = "The uploaded file was only partially uploaded";
            break;
        case UPLOAD_ERR_NO_FILE:
            $message = "No file was uploaded";
            break;
        case UPLOAD_ERR_NO_TMP_DIR:
            $message = "Missing a temporary folder";
            break;
        case UPLOAD_ERR_CANT_WRITE:
            $message = "Failed to write file to disk";
            break;
        case UPLOAD_ERR_EXTENSION:
            $message = "File upload stopped by extension";
            break;

        default:
            $message = "Unknown upload error";
            break;
    }
    return $message;
}
?>