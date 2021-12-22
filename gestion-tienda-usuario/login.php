<?php
    // session_start();
    require_once 'conf/config.inc';
    require_once 'functions.php';
    // include 'checkAuthCookie.php'; 
    // include 'checkAuthSession.php'; 

    // setcookie("nombre","",time()-3600,"/unidad4/mantenimiento/");
    // setcookie("password","",time()-3600,"/unidad4/mantenimiento/");
    $mensaje="";
    if(isset($_COOKIE['nombre']) && isset($_COOKIE['password'])){
        $n = $_COOKIE['nombre'];
        $p = $_COOKIE['password'];
        $ok = checkUser($n,$p);
        if($ok != false){
            header("Location: tienda-online.php");
        }
    }else{
        header("Location: login.php");
        if(isset($_POST['nombre']) && isset($_POST['password'])){ // si se ha enviado
            if(!empty($_POST['nombre']) && !empty($_POST['password'])){ // si no están vacios
                $nombre = $_POST['nombre'];
                $pass = $_POST['password'];
                if(checkUser($nombre,$pass)){
                    $mensaje = "Datos de usuario incorrectos";
                }else{
                    setcookie("nombre",$nombre,time()+10600,"/unidad4/gestion-tienda-usuario/");
                    setcookie("password",$pass,time()+10600,"/unidad4/gestion-tienda-usuario/");
                    // $_SESSION['nombre'] = $nombre;
                    // $_SESSION['password'] = $pass;
                    header("Location: tienda-online.php");       
                }
            }else{
                $mensaje = "El usuario y la contraseña no pueden estar vacíos.";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action ="" method="POST">
        <fieldset>
            <legend>LOGIN</legend>
            <label for="nombre">Usuario: </label>
            <input name ="nombre" type = "text" size=20 value="">
            <br><br><label for="password">Contraseña: </label>
            <input name ="password" type = "password" size=20 value="">
            <br><br><input name="submit" type = "submit" value="ENVIAR">
            <input name="reset" type = "reset" value="RESET">
        </fieldset>
    </form>
</body>
</html>

<?=$mensaje?>