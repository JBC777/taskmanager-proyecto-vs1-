<?php
session_start();
// Protección de ruta: solo usuarios con rol "usuario" pueden acceder
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'usuario') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Bienvenido, Usuario</h1>
        <p>Este es tu panel personal. Puedes gestionar tus tareas y preferencias.</p>
        <a href="logout.php" class="btn btn-secondary">Cerrar sesión</a>
    </div>
</body>
</html>