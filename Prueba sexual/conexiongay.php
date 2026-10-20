<?php
// 1. Definimos los datos del servidor
$host = "localhost";
$dbname = "azka_instituto"; // Cambia esto por el nombre real
$usuario = "root";                     // Usuario por defecto en local
$password = "";                        // Contraseña (suele estar vacía en local)

try {
    // 2. Creamos la conexión usando PDO
    $conexion = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $usuario, $password);
    
    // 3. Activamos el manejo de errores para que nos avise si algo falla
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Opcional: Descomenta la siguiente línea temporalmente para probar si conectó
    echo "¡Conexión exitosa a la base de datos!";

} catch (PDOException $e) {
    // Si hay un error, lo atrapamos aquí y mostramos el mensaje
    echo "Error de conexión: " . $e->getMessage();
}
?>