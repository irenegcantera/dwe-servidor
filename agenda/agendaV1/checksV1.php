<?php
    $error = "";
    $contactos = "";

    $nombreArray = array();
    $telfArray = array();

    if(isset($_REQUEST['enviar'])){
        if(isset($_REQUEST['nombres']) && isset($_REQUEST['telefonos'])){
            $nombreArray = explode(";", $_REQUEST['nombres']);
            $telfArray = explode(";", $_REQUEST['telefonos']);

            // el nombre se pasa a minúsculas (strtolower) y la primera letra de cada palabra a mayúsculas (ucwords)
            $nombre = ucwords(strtolower($_REQUEST['nombre']));
            $telefono = $_REQUEST['telefono'];

            if($nombre != null){
                if(in_array($nombre, $nombreArray)){ // si el nombre introducido existe en el array 
                    $indice = array_search($nombre, $nombreArray); // obtener la posición del nombre en el array
                    
                    // si el télefono no está vacío y tiene una longitud de 9
                    if(($telefono != null) && (strlen($telefono) == 9)){ 
                        $telfArray[$indice] = $telefono; // modificar el teléfono
                    }else{
                        $error = "NO SE HA INTRODUCIDO UN TELÉFONO O NO TIENE LA LONGITUD SUFICIENTE.<br>";
                        $error .= "Eliminando el contacto...";

                        // si está vacío eliminar el registro de cada array
                        unset($nombreArray[$indice]);
                        unset($telfArray[$indice]);
                    }
                }else{
                    // si no existe el nombre y se registro un teléfono de longitud 9
                    if(($telefono != null) && (strlen($telefono) == 9)){
                        if(in_array($telefono,$telfArray)){
                            $error = "El teléfono ya existe en la agenda.";
                        }else{
                            // se añade los valores de nombre y teléfono a sus respectivos array
                            array_push($nombreArray, $nombre);
                            array_push($telfArray, $telefono);
                        }
                    }else{
                        $error = "NO SE HA INTRODUCIDO UN TELÉFONO O NO TIENE LA LONGITUD SUFICIENTE";
                    }
                }
            }else{
                $error = "Los campos son obligatorios.";
            }
        }else{
            $error = "Los campos son obligatorios.";
        }
    }

    if (isset($_REQUEST['enviar'])){
        if(isset($_REQUEST['nombres']) && isset($_REQUEST['telefonos'])){
            $contactos .= "<table class='table table-hover'>
                    <tr>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                    </tr>";
            foreach ($nombreArray as $i => $n) {
                if($i != 0){
                    $contactos .= "<tr><td>$nombreArray[$i]</td>"; 
                    $contactos .= "<td>$telfArray[$i]</td></tr>";
                }
            }
            $contactos .= "</table>";
        }
    }
?>