<?php
$error = "";
$contactos = array();
if(isset($_REQUEST['enviar'])){
    eval('$contactos='.$_REQUEST['datos'].';');
    if(isset($_REQUEST['nombre']) && isset($_REQUEST['telefono'])){
        // el nombre se pasa a minúsculas y la primera letra de cada palabra a mayúsculas
        $nombre = ucwords(strtolower($_REQUEST['nombre'])); 
        $telefono = $_REQUEST['telefono'];
        
        if($nombre != null){
            // si el array está vacío y el teléfono tiene una longitud de 9 introducimos el registro 
            if(count($contactos) == 0){
                if((strlen($telefono) == 9)){
                    $contactos = [$nombre => $telefono]; 
                }else{
                    $error = "NO SE HA INTRODUCIDO UN TELÉFONO O NO TIENE LA LONGITUD SUFICIENTE";
                }
            }else{
                foreach($contactos as $n => $t){
                    if($nombre == $n){
                        // si el télefono no está vacío y tiene una longitud de 9
                        if(($telefono != null) && (strlen($telefono) == 9)){
                            $contactos[$n] = $telefono; // modificar teléfono si el nombre ya existe
                        }else{
                            $error = "NO SE HA INTRODUCIDO EL TELÉFONO O NO TIENE LA LONGITUD SUFICIENTE<br>";
                            $error .= "Eliminando el contacto...";
                            // si está vacío eliminar el registro
                            unset($contactos[$n]); 
                        }
                    }else{
                        // si no existe el nombre y se registro un teléfono de longitud 9
                        if(($telefono != null) && (strlen($telefono) == 9)){
                            if(!in_array($telefono,$contactos)){
                                $contactos[$nombre] = $telefono; // se añade la clave nombre y el valor teléfono
                            }else{
                                $error = "El teléfono ya existe en la agenda.";
                            }   
                        }else{
                            $error = "NO SE HA INTRODUCIDO UN TELÉFONO O NO TIENE LA LONGITUD SUFICIENTE";
                        }
                    }
                }
            }
        }else{
            $error = "Los campos son obligatorios.";
        }
    }
}

// si el array contactos no está vacío se muestra la tabla con los contactos
if(!empty($contactos)){
    // mostrar la tabla por pantalla
    echo "<table border>";
    echo "<tr>
            <th>Nombre</th>
            <th>Teléfono</th>
        </tr>";
    foreach ($contactos as $n => $t) {
        echo "<tr><td>$n</td><td>$t</td></tr>"; 
    }
    echo "<table>"; 
}
?>