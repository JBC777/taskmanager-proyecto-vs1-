<?php
// ==================================================
// register.php - Registro de nuevos usuarios
// Autor: Jaime Bolívar Castañeda
// Sistema: TaskManager Seguro - Criptografía UNIMINUTO
// ==================================================

// Incluir la configuración de la base de datos
require_once 'config.php';

// Inicializar variables para mostrar mensajes
$mensaje = "";
$error = "";

// Verificar si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recoger los datos del formulario
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validar que los campos no estén vacíos
    if (empty($username) || empty($password) || empty($confirm_password)) {
        $error = "Por favor, completa todos los campos.";
    } elseif ($password !== $confirm_password) {
        $error = "Las contraseñas no coinciden.";
    } else {
        // Generar el hash seguro de la contraseña
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // Preparar la consulta SQL (usamos prepared statements para prevenir inyecciones SQL)
        $stmt = $conexion->prepare("INSERT INTO usuarios (username, password_hash, rol) VALUES (?, ?, 'usuario')");
        $stmt->bind_param("ss", $username, $password_hash);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            $mensaje = "✅ Usuario registrado con éxito. Puedes iniciar sesión ahora.";
        } else {
            $error = "❌ Error al registrar el usuario: " . $stmt->error;
        }

        // Cerrar la sentencia
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - TaskManager Seguro</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Registro de Usuario</h2>

        <!-- Mostrar mensaje de éxito o error -->
        <?php if (!empty($mensaje)): ?>
            <div class="alert alert-success" role="alert">
                <?= $mensaje ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger" role="alert">
                <?= $error ?>
            </div>
        <?php endif; ?>

        <!-- Formulario de registro -->
        <form method="POST" action="">
            <div class="mb-3">
                <label for="username" class="form-label">Nombre de usuario:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirmar contraseña:</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
            <a href="login.php" class="btn btn-secondary ms-2">Iniciar Sesión</a>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>