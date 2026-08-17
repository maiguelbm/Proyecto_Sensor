<?php
include 'Conexion.php';

// Verificar si los datos fueron enviados
if (isset($_GET['temperatura']) && isset($_GET['humedad'])) {
    $temperatura = $_GET['temperatura'];
    $humedad = $_GET['humedad'];

    // Preparar la consulta para evitar inyección SQL
    $sql = "INSERT INTO datos (temperatura, humedad, fecha) VALUES (?, ?, NOW())";
    $stmt = mysqli_prepare($conexion, $sql);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "dd", $temperatura, $humedad);
        mysqli_stmt_execute($stmt);
        echo "Datos insertados correctamente.";
        mysqli_stmt_close($stmt);
    } else {
        echo "Error en la consulta: " . mysqli_error($conexion);
    }
} else {
    echo "Faltan datos.";
}
?>

