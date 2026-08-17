<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Inicio de Sesión</h2>
        
        <form action="validar_login.php" method="POST">
            <div class="mb-3">
                <label for="Correo" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="Correo" name="Correo" required>
            </div>
            <div class="mb-3">
                <label for="Contraseña" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="Contraseña" name="Contraseña" required>
            </div>
            <p>¿Aun no te has registrado? <a href="Registro.php">Regístrate aquí</a></p>
            <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

