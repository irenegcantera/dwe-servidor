<?php
include_once("config.inc"); // cargar fichero de configuración

/* Función de conexión con la base de datos */
function connection() {
    $connection = new mysqli($GLOBALS['host'],$GLOBALS['user'],$GLOBALS['pass'],$GLOBALS['base']);
    $error = $connection -> connect_errno;
    return ($error == 0) ? $connection : null;
}

/* Función que almacena el nombre, teléfono y la ruta de la foto en el fichero. Además, la foto se guarda en una subcarpeta */
function addContactos($nombre,$telf,$foto) {
    // conectar con la base de datos y comprobar si se ha realizado correctamente
    $connection = connection();
    if($connection != null){
        $ruta = moveFoto($nombre,$foto);
        $consulta = $connection -> query("INSERT INTO contactos VALUES ('$nombre','$telf','$ruta')");
        $connection -> close();
        
    }else{
        echo "SIN CONEXIÓN";
    }
}

function moveFoto($nombre,$foto){
    // mover la foto al directorio photos
    $temporal = $foto['tmp_name'];
    $partes = explode(".", $foto['name']);
    $extension= strtolower(end($partes));
    $rutaFoto = "./files/photos/".$nombre.".".$extension;
    move_uploaded_file($temporal,$rutaFoto); // ruta anterior, ruta nueva
    return $rutaFoto;
}

/* Función que lee el fichero y recupera la información guardandola en un array */
function getContactos(){
    $connection = connection();
    $datos = array(); // nuevo array bidimensional
    if($connection != null){
        $consulta = $connection -> query("SELECT * FROM contactos");
        while($row = $consulta -> fecth_object()){
            $array[] = $row;
        }
        $connection -> close();
    }else{ 
        echo "SIN CONEXIÓN";
    }
    return $array;
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

/* Función que actualiza SOLO el nombre del contacto */
function updateContacto($nomAnt,$nombre,$telf,$foto){
    $datos = getContactos();
    foreach($datos as $key => $value){
        foreach($value as $k => $v){
            if($v == $nomAnt){
                $datos[$key][$k] = $nombre;
                // renombramos la foto del directorio con el nuevo nombre
                rename($foto,"./files/photos/".$nombre.".jpg");
                // cambiamos el nombre a la foto del array de datos también
                $datos[$key][2] = "./files/photos/".$nombre.".jpg";
            }
        }
    }
    saveContactos($datos);
}
?>