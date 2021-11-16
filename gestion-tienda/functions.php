<?php
require 'functionsCRUD.php';

// ARCHIVO PHP CON FUNCIONES DE LA APLICACIÓN
// Añadir fotos a los productos
// mover foto a la carpeta img de productos
// obtener la extensión de la foto
// cambiar el nombre a primarykey.extension
function moveRenameImg($cod,$foto){
    $temporal = $foto['tmp_name'];
    $partes = explode(".", $foto['name']);
    $extension = strtolower(end($partes));
    $rutaFoto = "./productos/img/".$cod.".".$extension;
    move_uploaded_file($temporal,$rutaFoto);
    return $cod.".".$extension;
}

/* Función que muestra los datos de la base de datos en la tabla producto */
function showDatosProductos(){
    $db = connection(); // ABRIR CONEXIÓN
    $consulta = $db -> query("SELECT * FROM producto",PDO::FETCH_OBJ);

    //tabla con datos
    echo "<table border><tr>   
            <th>CÓDIGO</th>
            <th>NOMBRE</th>
            <th>NOMBRE CORTO</th>
            <th>DESCRIPCIÓN</th>
            <th>FOTO</th>
            <th>PVP</th>
            <th>FAMILIA</th> 
            <th>OPERACIONES</th> 
        </tr>";
    while($row = $consulta -> fetch()){
        echo "<tr><td>".$row -> cod."</td>";
        echo "<td>".$row -> nombre."</td>";
        echo "<td>".$row -> nombre_corto."</td>";
        echo "<td>".$row -> descripcion."</td>";
        echo "<td>".$row -> foto."</td>";
        echo "<td>".$row -> PVP."</td>";
        echo "<td>".$row -> familia."</td>";
        echo "<td><a href = 'crear.php?editar=true&cod=".$row -> cod."'>Editar</a><br><a href='listar.php?eliminar=true&cod=".$row -> cod."'>Eliminar</a></td></tr>";
    }
    echo "</table>";

    // cerrar la conexión e instancias
    $consulta = null;
    $row = null;
    $db = null;
}

/* Función que muestra los datos de la base de datos en la tabla familia */
function showDatosFamilias(){
    $db = connection(); // ABRIR CONEXIÓN
    $consulta = $db -> query("SELECT * FROM familia",PDO::FETCH_OBJ);

    //tabla con datos
    echo "<table border><tr>   
            <th>CÓDIGO</th>
            <th>NOMBRE</th>
            <th>OPERACIONES</th> 
        </tr>";
    while($row = $consulta -> fetch()){
        echo "<tr><td>".$row -> cod."</td>";
        echo "<td>".$row -> nombre."</td>";
        echo "<td><a href = 'crear.php?editar=true&cod=".$row -> cod."'>Editar</a><br><a href='listar.php?eliminar=true&cod=".$row -> cod."'>Eliminar</a></td></tr>";
    }
    echo "</table>";

    // cerrar la conexión e instancias
    $consulta = null;
    $row = null;
    $db = null;
}

/* Función que muestra los datos de la base de datos en la tabla tienda */
function showDatosTiendas(){
    $db = connection(); // ABRIR CONEXIÓN
    $consulta = $db -> query("SELECT * FROM tienda",PDO::FETCH_OBJ);

    //tabla con datos
    echo "<table border><tr>   
            <th>CÓDIGO</th>
            <th>NOMBRE</th>
            <th>TELÉFONO</th>
            <th>OPERACIONES</th> 
        </tr>";
    while($row = $consulta -> fetch()){
        echo "<tr><td>".$row -> cod."</td>";
        echo "<td>".$row -> nombre."</td>";
        echo "<td>".$row -> tlf."</td>";
        echo "<td><a href = 'crear.php?editar=true&cod=".$row -> cod."'>Editar</a><br><a href='listar.php?eliminar=true&cod=".$row -> cod."'>Eliminar</a></td></tr>";
    }
    echo "</table>";

    // cerrar la conexión e instancias
    $consulta = null;
    $row = null;
    $db = null;
}

/* Función que muestra el stock de los productos que hay en cada tienda */
function showStockTiendas(){
    $db = connection(); // abrir   
    $tiendas = $db -> query("SELECT tienda.nombre,stock.tienda FROM tienda INNER JOIN stock ON tienda.cod = stock.tienda GROUP BY tienda.nombre"); 

    echo "<br><div style ='display: flex; flex-direction: row; justify-content: space-evenly;'>";
    foreach($tiendas as $tienda){
        $registro = $db -> query("SELECT * FROM stock WHERE tienda ='".$tienda[1]."'",PDO::FETCH_OBJ); // en la posición 1 está el código
        // tabla con el showStock
        echo "<div><h3>TIENDA ".$tienda[0]."</h3>"; // en la posición cero está el nombre de la tienda
        echo "<table border><tr>   
            <th>PRODUCTO</th>
            <th>UNIDADES</th>
        </tr>";
        while($row = $registro -> fetch()){
            echo "<tr><td>".$row -> producto."</td>";
            echo "<td>".$row -> unidades."</td></tr>";
        }
        echo "</table></div>";
    }
    echo "</div>";
    // cerrar todo
    $tiendas = null;
    $registro = null;
    $row = null;
    $db = null;
}

/* Función que muestra la cantidad de productos que hay en el stock */
function showStockProductos(){
    $db = connection(); // ABRIR 
    $registro = $db -> query("SELECT stock.producto, producto.nombre_corto, SUM(stock.unidades) AS suma FROM stock INNER JOIN producto ON stock.producto = producto.cod GROUP BY producto", PDO::FETCH_OBJ);
    // tabla
    echo "<div><h3>Stock de los productos</h3>";
    echo "<table border><tr>   
        <th>PRODUCTO</th>
        <th>NOMBRE</th>
        <th>UNIDADES</th>
    </tr>";
    while($row = $registro -> fetch()){
        echo "<tr><td>".$row -> producto."</td>";
        echo "<td>".$row -> nombre_corto."</td>";
        echo "<td>".$row -> suma."</td></tr>";
    }
    echo "</table></div>";
    // cerrar todo
    $registro = null;
    $row = null;
    $db = null;
}

/* Función que muestra los datos de la búsqueda de un producto */
function searchProductos(){
    $db = connection(); // ABRIR CONEXIÓN
    $registro = $db -> query("SELECT * FROM producto WHERE nombre_corto LIKE '%".strtoupper($_REQUEST['nombre'])."%'",PDO::FETCH_OBJ);

    //tabla con datos
    echo "<table border><tr>   
            <th>CÓDIGO</th>
            <th>NOMBRE</th>
            <th>NOMBRE CORTO</th>
            <th>DESCRIPCIÓN</th>
            <th>FOTO</th>
            <th>PVP</th>
            <th>FAMILIA</th> 
            <th>OPERACIONES</th> 
        </tr>";
    while($row = $registro -> fetch()){
        echo "<tr><td>".$row -> cod."</td>";
        echo "<td>".$row -> nombre."</td>";
        echo "<td>".$row -> nombre_corto."</td>";
        echo "<td>".$row -> descripcion."</td>";
        echo "<td>".$row -> foto."</td>";
        echo "<td>".$row -> PVP."</td>";
        echo "<td>".$row -> familia."</td>";
        echo "<td><a href = 'crear.php?editar=true&cod=".$row -> cod."'>Editar</a><br><a href='listar.php?eliminar=true&cod=".$row -> cod."'>Eliminar</a></td></tr>";
    }
    echo "</table>";

    // cerrar la conexión e instancias
    $consulta = null;
    $row = null;
    $db = null;
}

/* Función que muestra los datos de la búsqueda de un producto */
function searchFamilias(){
    $db = connection(); // ABRIR CONEXIÓN
    $registro = $db -> query("SELECT * FROM familia WHERE nombre LIKE '%".$_REQUEST['nombre']."%'",PDO::FETCH_OBJ);

    //tabla con datos
    echo "<table border><tr>   
            <th>CÓDIGO</th>
            <th>NOMBRE</th>
            <th>OPERACIONES</th> 
        </tr>";
    while($row = $registro -> fetch()){
        echo "<tr><td>".$row -> cod."</td>";
        echo "<td>".$row -> nombre."</td>";
        echo "<td><a href = 'crear.php?editar=true&cod=".$row -> cod."'>Editar</a><br><a href='listar.php?eliminar=true&cod=".$row -> cod."'>Eliminar</a></td></tr>";
    }
    echo "</table>";

    // cerrar la conexión e instancias
    $consulta = null;
    $row = null;
    $db = null;
}

/* Función que muestra los datos de la búsqueda de un producto */
function searchTiendas(){
    $db = connection(); // ABRIR CONEXIÓN
    $registro = $db -> query("SELECT * FROM tienda WHERE nombre LIKE '%".$_REQUEST['nombre']."%'",PDO::FETCH_OBJ);

    //tabla con datos
    echo "<table border><tr>   
            <th>CÓDIGO</th>
            <th>NOMBRE</th>
            <th>TELÉFONO</th>
            <th>OPERACIONES</th> 
        </tr>";
    while($row = $registro -> fetch()){
        echo "<tr><td>".$row -> cod."</td>";
        echo "<td>".$row -> nombre."</td>";
        echo "<td>".$row -> tlf."</td>";
        echo "<td><a href = 'crear.php?editar=true&cod=".$row -> cod."'>Editar</a><br><a href='listar.php?eliminar=true&cod=".$row -> cod."'>Eliminar</a></td></tr>";
    }
    echo "</table>";

    // cerrar la conexión e instancias
    $consulta = null;
    $row = null;
    $db = null;
}

/* Función que obtiene el directorio en el que se ejecuta crear.php */
function obtainDirectory(){
    $dirArray = explode("/", $_SERVER['PHP_SELF']);
    foreach($dirArray as $dir){
        if($dir == "productos"){
            return "productos";
        }else if($dir == "familias"){
            return "familias";
        }else if($dir == "tiendas"){
            return "tiendas";
        }
    }
}
?>