<?php
$hostname = "localhost";
$username = "root";
$password = "";
$bd_name  = "sensor";

// Conectala base de datos
$conexion = mysqli_connect($hostname, $username, $password, $bd_name);

// Verifica la conexión
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}


?>


<!-- ya verifique que esta correcto  :') -->
