<?php
session_start();
require_once 'config.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $error = "Completa todos los campos.";
    } else {
        $stmt = $conexion->prepare("SELECT id, username, password_hash, rol FROM usuarios WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($user = $result->fetch_assoc()) {
            if (password_verify($password, $user['password_hash'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['rol'] = $user['rol'];

                // Redirección por roles
                switch ($user['rol']) {
                    case 'admin':
                        header("Location: admin.php");
                        exit();
                    case 'usuario':
                        header("Location: user.php");
                        exit();
                    case 'invitado':
                        header("Location: guest.php");
                        exit();
                }
            } else {
                $error = "Credenciales incorrectas.";
            }
        } else {
            $error = "Usuario no existe.";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - TaskManager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Iniciar Sesión</h2>
    <?php if ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    <form method="POST">
        <input type="text" name="username" placeholder="Usuario" class="form-control mb-2" required>
        <input type="password" name="password" placeholder="Contraseña" class="form-control mb-2" required>
        <button type="submit" class="btn btn-primary">Entrar</button>
        <a href="register.php" class="btn btn-link">¿No tienes cuenta?</a>
    </form>
</div>
</body>
</html>