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

/* Función que muestra la tabla */
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
                if ($k != 2){ // si la clave es igual al índice, se imprime la imagen
                    echo "<td>$v</td>";
                }else{
                    echo "<td><img src='$v' style = 'width:25%'></td>";
                }
            }
            // 0 es la posición del nombre y 1 del teléfono
            echo "<td><a href = crear.php?editar=true&nombre=".$datos[$key][0]."&telefono=".$datos[$key][1].">Editar</a>
                    <a href = listar.php?nombre=".$datos[$key][0].">Eliminar</a></td>"; // mostrar enlaces de Editar y Eliminar
            echo "</tr>";
        }
        echo "</table><br>";
    }else{
        echo "<p>NO HAY NINGÚN CONTACTO EN LA AGENDA</p>";
    }
}

function saveContactos($datos){
    unlink(FICHERO); // ELIMINar fichero
    foreach($datos as $key => $value){
        foreach($value as $k => $v){
            //print_r($v);
            if ($k != 2){
                file_put_contents(FICHERO, $v.";", FILE_APPEND);
            }else{
                file_put_contents(FICHERO, $v, FILE_APPEND); // para que no se sobreescriba
            }
             
        }   
        file_put_contents(FICHERO, "\n", FILE_APPEND);
    }
    
}

// deleteContacto($nombre). Elimina el contacto cuyo nombre coincida con el parámetro.
function deleteContacto($nombre){
    $datos = getContactos();
    foreach($datos as $key => $value){
        foreach($value as $k => $v){
            if($v == $nombre){
                array_splice($datos, $key, 1);
                $ruta = $value[2];
                unlink($ruta);
            }
        }
    }        
    saveContactos($datos);
}
// updateContacto($nomAnt,$nombre,$telefono,$foto). Actualiza el contacto cuyo nombre coincida con $nomAnt con los nuevos datos. También puedes eliminar y añadir.
function updateContacto($nomAnt,$nombre,$telf,$foto){
    $datos = getContactos();
    foreach($datos as $key => $value){
        foreach($value as $k => $v){
            if($v == $nomAnt){
                $datos[$key][$k] = $nombre;
                // renombramos la foto con el nuevo nombre
                rename($foto,"./files/photos/".$nombre.".jpg");
                // cambiamos el nombre a la foto también en el fichero
                $datos[$key][2] = "./files/photos/".$nombre.".jpg";
                //echo "se ha reemplazado";
            }
        }
    }
    saveContactos($datos);
}
?>