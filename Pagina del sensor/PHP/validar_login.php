<?php
// inicia la sesión este es el parametro
session_start();

// lo primero que hay que hacer
include 'Conexion.php';

// pedimos a la bd los datos del formulario
$Correo = $_POST['Correo'];
$Contraseña = $_POST['Contraseña'];

// Consultamos para validar las informacion enviada desd el formulario de inicio de sesion a este 
$sql = "SELECT * FROM registro WHERE Correo = '$Correo' AND Contraseña = '$Contraseña'";
$resultado = mysqli_query($conexion, $sql);

// Verifica si se encontró el usuario o no
if (mysqli_num_rows($resultado) == 1) {

    // Usuario si si se encontro el usuario pues  Inicia sesión y envia al index luego me toca colocar el de si no :''v 

    $usuario = mysqli_fetch_assoc($resultado);
    $_SESSION['Usuario'] = $usuario['Usuario']; // Guarda el nombre del usuario en la sesión
    $_SESSION['Correo'] = $usuario['Correo'];   // Guarda el correo en la sesión
   
    header('Location: index.php'); // Redirigir al indix
    exit();

} else {
    // si la informacion es incorrecta: Muetra mensaje de error con un alert y reenvia al incio sesion o sea vuelve a cargar la pagina
    echo "<script>
        alert('Correo o contraseña incorrectos.');
        window.location.href = 'inicio_sesion.php';
    </script>";
}
?>



<!-- me quiero morir :"v  -->
