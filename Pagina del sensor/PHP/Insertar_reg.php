<?php

include 'Conexion.php';

// Verificar si los datos fueron enviados
if (!empty($_POST['Identificacion']) && !empty($_POST['Documento']) && !empty($_POST['Telefono']) && 
    !empty($_POST['Usuario']) && !empty($_POST['Correo']) && !empty($_POST['Contraseña'])) {

    $Identificacion = $_POST['Identificacion'];
    $Documento = $_POST['Documento'];
    $Telefono = $_POST['Telefono'];
    $Usuario = $_POST['Usuario'];
    $Correo  = $_POST['Correo'];
    $Contraseña =$_POST['Contraseña'];

    // Verificar si el usuario ya existe
    $sql_check = "SELECT * FROM registro WHERE Usuario = '$Usuario' OR Correo = '$Correo'";
    $resultado_check = mysqli_query($conexion, $sql_check);

    if (mysqli_num_rows($resultado_check) > 0) {
        echo "Error: El usuario o correo ya está registrado.";
    } else {
        // Insertar los datos
        $sql = "INSERT INTO registro (Identificacion, Documento, Telefono, Usuario, Correo, Contraseña) 
                VALUES ('$Identificacion', '$Documento', '$Telefono', '$Usuario', '$Correo', '$Contraseña')";
        if (mysqli_query($conexion, $sql)) {
            header('Location: Registro.php'); // Redirigir al registro
            exit();
        } else {
            echo "Error al insertar datos: " . mysqli_error($conexion);
        }
    }
} else {
    echo "Todos los campos son obligatorios.";
}
?>
