<?php
// Incluir la conexión a la base de datos
include 'Conexion.php';

// Dirección IP del ESP32 (ajústala con la IP que obtuviste)
$esp32_ip = "192.168.1.3"; // IP real
$esp32_url = "http://$esp32_ip/read";  // Endpoint del ESP32

// Configuración para aumentar el tiempo de espera de la conexión
$options = [
    "http" => [
        "timeout" => 10 // 10 segundos de espera
    ]
];
$context = stream_context_create($options);

try {
    // Hacer la solicitud HTTP al ESP32
    $response = file_get_contents($esp32_url, false, $context);

    // Verificar si la respuesta es válida
    if (!$response) {
        throw new Exception('No se pudo conectar con el ESP32.');
    }

    // Convertir la respuesta JSON en un arreglo PHP
    $data = json_decode($response, true);

    // Verificar si la decodificación fue exitosa
    if (!$data) {
        throw new Exception('Respuesta inválida del ESP32: ' . $response);
    }

    // Obtener los datos de temperatura y humedad
    $temperatura = $data['temperatura'] ?? null;
    $humedad = $data['humedad'] ?? null;

    if (is_null($temperatura) || is_null($humedad)) {
        throw new Exception('Datos incompletos del ESP32.');
    }

    // Insertar los datos en la base de datos
    $sql = "INSERT INTO datos (temperatura, humedad, fecha) VALUES ('$temperatura', '$humedad', NOW())";
    
    if (!mysqli_query($conexion, $sql)) {
        throw new Exception("Error en la base de datos: " . mysqli_error($conexion));
    }

    // Redirigir a la página de resultados
    header("Location: mostrar_datos.php");
    exit();

} catch (Exception $e) {
    echo "<script>
        alert('{$e->getMessage()}');
        window.location.href = 'mostrar_datos.php';
    </script>";
    exit();
}
?>
