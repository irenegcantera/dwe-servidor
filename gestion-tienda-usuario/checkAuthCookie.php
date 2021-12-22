<?php
$mensajecheck = "";
    if(isset($_COOKIE['nombre']) && isset($_COOKIE['password'])){
        $n = $_COOKIE['nombre'];
        $p = $_COOKIE['password'];
        $ok = checkUser($n,$p);
        if($ok != false){
            $mensajecheck = "Error1";
            // header("Location: login.php");
        }
    }else{
        $mensajecheck = "Error2";
        // header("Location: login.php");
    }
?>