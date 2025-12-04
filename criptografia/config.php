<?php
// ==================================================
// config.php - Configuración de la base de datos
// Autor: Jaime Bolívar Castañeda
// Sistema: TaskManager Seguro - Criptografía UNIMINUTO
// ==================================================

// Definir constantes para la conexión a la base de datos
define('DB_HOST', 'localhost:33065');  // Servidor de la base de datos
define('DB_USER', 'root');          // Usuario de MySQL (por defecto en XAMPP)
define('DB_PASS', '');              // Contraseña de MySQL (vacía por defecto en XAMPP)
define('DB_NAME', 'taskmanager_seguridad'); // Nombre de la base de datos

// Establecer la conexión con MySQL
$conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Verificar si hay errores en la conexión
if ($conexion->connect_error) {
    die("❌ Error de conexión: " . $conexion->connect_error);
}

// Establecer el conjunto de caracteres a UTF-8 para evitar problemas con tildes y caracteres especiales
$conexion->set_charset("utf8");

// Opcional: Mostrar mensaje de conexión exitosa (solo para desarrollo)
// echo "✅ Conexión a la base de datos establecida correctamente.";

?>