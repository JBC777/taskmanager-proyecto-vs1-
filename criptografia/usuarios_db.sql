-- ==================================================
-- usuarios_db.sql
-- Sistema de Autenticación Seguro — Criptografía (UNIMINUTO)
-- Autor: Jaime Bolívar Castañeda
-- ==================================================

-- 1. Crear la base de datos (si no existe)
CREATE DATABASE IF NOT EXISTS taskmanager_seguridad;

-- 2. Usar la base de datos
USE taskmanager_seguridad;

-- 3. Crear la tabla de usuarios
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,                 -- ID único y autoincremental
    username VARCHAR(50) NOT NULL UNIQUE,             -- Nombre de usuario único
    password_hash VARCHAR(255) NOT NULL,              -- Hash seguro de la contraseña (bcrypt)
    rol ENUM('admin', 'usuario', 'invitado') NOT NULL DEFAULT 'usuario', -- Rol del usuario
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP    -- Fecha de creación
);

-- 4. Insertar 3 usuarios de ejemplo (contraseñas en texto plano: admin123, user123, guest123)
--    ⚠️ Estos hashes son válidos para PHP 8+ con password_hash('contraseña', PASSWORD_DEFAULT)
INSERT INTO usuarios (username, password_hash, rol) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin'),
('user', '$2y$10$92IXUNpkjO0rQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'usuario'),
('guest', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'invitado');