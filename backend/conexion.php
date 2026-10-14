<?php
// conexion.php - Conexión a MySQL con PDO (XAMPP: root sin contraseña)

$dsn = "mysql:host=localhost;dbname=azka_instituto;charset=utf8mb4";
$usuario = "root";
$clave = "";

try {
    $conexion = new PDO($dsn, $usuario, $clave);
    // PDO lanza excepciones cuando hay un error de SQL
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // No se muestra el error interno, solo un mensaje general
    die("Error al conectar con la base de datos.");
}
