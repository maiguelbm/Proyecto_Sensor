<?php
session_start();

if (!isset($_SESSION['Usuario'])) {
    header('Location: inicio_sesion.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lecturas del Sensor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Lecturas del Sensor</h1>

        <?php
        include 'Conexion.php';

        // Consulta segura con verificación
        $query = "SELECT fecha, temperatura, humedad FROM datos ORDER BY fecha DESC";
        $result = mysqli_query($conexion, $query);

        if (!$result) {
            echo "<p class='alert alert-danger'>Error al obtener los datos: " . mysqli_error($conexion) . "</p>";
        } elseif (mysqli_num_rows($result) > 0) {
            echo "<table class='table table-striped table-bordered'>";
            echo "<thead class='table-dark'>";
            echo "<tr><th>Fecha</th><th>Temperatura (°C)</th><th>Humedad (%)</th></tr>";
            echo "</thead>";
            echo "<tbody>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['fecha']) . "</td>";
                echo "<td>" . htmlspecialchars($row['temperatura']) . "</td>";
                echo "<td>" . htmlspecialchars($row['humedad']) . "</td>";
                echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";
        } else {
            echo "<p class='text-center alert alert-info'>No hay datos registrados aún.</p>";
        }
        ?>
    </div>
    <a href="index.php" class="btn btn-primary">Volver al inicio</a>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

