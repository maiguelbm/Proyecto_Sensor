<?php
session_start();

if (!isset($_SESSION['Usuario'])) {
    header('Location: inicio_sesion.php');
    exit();
}


//Esto es para obtener los nombres de las redes y direccion ip *lo doxxea °w°*
include 'Conexion.php';

// para la dirección IP pública del usuario mediante comando shell
function getPublicIP() {
    $command = "curl ifconfig.me"; 
    $ip = shell_exec($command);
    return trim($ip);
}

// esto es para el nombre de la red el (SSID)
function getNombreRed() {
    $os = PHP_OS_FAMILY;
    if ($os === 'Linux') {
        $nombre_red = exec('iwgetid -r');
    } elseif ($os === 'Windows') {
        // esto ejecuta el comando para obtener el nombre de la red
        $output = shell_exec('netsh wlan show interfaces | findstr /C:" SSID"');
        // Extrae solo el nombre de la red
        $nombre_red = trim(explode(":", $output)[1]);
    } else {
        $nombre_red = 'Nombre de red no disponible';
    }
    return $nombre_red;
}

//variables que se utilizan para enviarlas a la BD
$ip_usuario = getPublicIP(); //Esto es la direcion IP
$nombre_red = getNombreRed();//Y esto es el nombre de la red
$usuario = $_SESSION['Usuario']; // Usuario con el que se hizo sesión
$correo = $_SESSION['Correo']; // correo del usuario de la sesion

// Verifica si la IP y el nombre de la red ya existen en la base de datos para este usuario y correo para actualizarlo o agregarlos
$sql = "SELECT * FROM usuarios_sesion WHERE usuario = '$usuario' AND correo = '$correo'";
$result = mysqli_query($conexion, $sql);

if (mysqli_num_rows($result) > 0) {
    // Si existe, actualizara la IP y el nombre de la red
    $sql_update = "UPDATE usuarios_sesion SET ip = '$ip_usuario', nombre_red = '$nombre_red' WHERE usuario = '$usuario' AND correo = '$correo'";
    mysqli_query($conexion, $sql_update);
} else {
    // Si no existe, los insertara en la tabla de todos modos :)
    $sql_insert = "INSERT INTO usuarios_sesion (usuario, correo, ip, nombre_red) VALUES ('$usuario', '$correo', '$ip_usuario', '$nombre_red')";
    mysqli_query($conexion, $sql_insert);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Contenedor principal con algo de espacio alrededor -->
    <div class="container mt-5 p-4 border rounded shadow-sm bg-light">
        <br>
        <!-- Botón para cerrar la sesión -->
        <a href="cierra_sesion.php" class="btn btn-danger mb-4">Cerrar Sesión</a>
        <br>
        <!-- Titulo-->
        <h2 class="text-center text-primary">¡Welcome To The Black Parade, <?php echo $_SESSION['Usuario']; ?>!</h2>
        <br>
        <!-- Correo con el cual se inicio -->
        <div class="mt-3 text-center">
            <p class="lead">Has iniciado sesión con el correo: <strong><?php echo $_SESSION['Correo']; ?></strong></p>
        </div>
        <br><br>
        <!-- Formulario para que el usuario ingrese la contraseña de la red wifi-->
        <div class="mt-4 text-center">
            <form action="solicitar_lectura.php" method="POST">
                <div class="mb-3">
                    <label for="nombre_red" class="form-label">Nombre de la Red (SSID): <?php echo $nombre_red; ?></label>
                    <input type="hidden" id="nombre_red" name="nombre_red" value="<?php echo $nombre_red; ?>">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña de la red wifi</label>
                    <input type="password" class="form-control" id="password" name="password" >
                </div>
                <button type="submit" class="btn btn-success btn-lg">Solicitar Lectura</button>
            </form>
            <br>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<!-- para no olvidar de donde me base :V -->

<!-- https://github.com/samir04m/SistemaVotacionWeb2018_NoDB/blob/075ab38aafabc453bdfafc1b5e9ca54354cb54d9/views/template.php-->

<!-- https://github.com/AngelSebastianGarciaSosa/garciaso/blob/ec867e09b1b0203052cd126e4c960db94ef76b7b/Parcial3/loginbasededatos/Bienvenido.php-->

<!-- https://github.com/brandondvm/progra4/blob/0bf2274cd06140bedb77b6b33809ecb0203396f8/View/agregar_usuario.php-->

<!-- https://github.com/Katsuhoku/webapp/blob/c088a92acc79519b6501077520a28b064c1e9c5f/TruequesFCC/pages/register.php-->

<!-- Y bueno algunos proyectos que ya tenia como son de cafe y eso =) -->