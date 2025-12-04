<?php
session_start();
// Protección de ruta: solo usuarios con rol "invitado" pueden acceder
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'invitado') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Invitado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Bienvenido, Invitado</h1>
        <p>Este es un acceso limitado. Puedes explorar funcionalidades básicas.</p>
        <a href="logout.php" class="btn btn-secondary">Cerrar sesión</a>
    </div>
</body>
</html>