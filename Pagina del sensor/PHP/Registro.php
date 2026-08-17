<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Registro del usuario</h2>

        
        <form action="Insertar_reg.php" method="POST">
            <div class="mb-3">
                <label for="Identificacion" class="form-label">Tipo de Identificación</label>
                <select class="form-select" id="Identificacion" name="Identificacion" required>
                    <option value="" disabled selected>¿Identificación?</option>
                    <option value="Identidad">Tarjeta de Identidad</option>
                    <option value="Ciudadania">Cédula de Ciudadanía</option>
                    <option value="Extranjeria">Cédula de Extranjería</option>
                    <option value="Otro">Otra</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="Documento" class="form-label">¿Cuál es su Documento?</label>
                <input type="text" class="form-control" id="Documento" name="Documento" required>
            </div>

            <div class="mb-3">
                <label for="Telefono" class="form-label">Teléfono</label>
                <input type="text" class="form-control" id="Telefono" name="Telefono" required>
            </div>

            <div class="mb-3">
                <label for="Usuario" class="form-label">¿Cuál es su Nombre?</label>
                <input type="text" class="form-control" id="Usuario" name="Usuario" required>
            </div>

            <div class="mb-3">
                <label for="Correo" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="Correo" name="Correo" required>
            </div>

            <div class="mb-3">
                <label for="Contraseña" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="Contraseña" name="Contraseña" required>
            </div>
            <p>¿Ya te has registrado? <a href="inicio_sesion.php">Inicia sesion aqui</a></p>
            <button type="submit" class="btn btn-primary">Registrarse</button>
        </form>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

