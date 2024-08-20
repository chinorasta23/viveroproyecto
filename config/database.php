<?php

$server ="localhost";
$user = "root";
$pass = "Nicolle123@";
$db = "vivero_db";

$conexion = new mysqli($server, $user, $pass, $db);

if($conexion->connect_errno) {
    die("Conexion fallida" .$conexion->connect_errno);

}else{
    echo"Conectado";
}

?>