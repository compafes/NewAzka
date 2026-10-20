<?php
include 'conexiongay.php'; // Incluimos el archivo de conexión a la base de datos

// CORREGIDO: Cambiamos 'id' por 'id_usuario' que es como se llama tu columna real
$sql = "SELECT * FROM usuarios WHERE id_usuario = 1";

$resultado = $conexion->query($sql);
$usuario_db = $resultado->fetch(PDO::FETCH_ASSOC);

$nombreusuario = $usuario_db['nombre_us'];
$Idusuario = $usuario_db['id_usuario'];

// Usamos echo para imprimir texto combinándolo con variables
echo "<div style='background-color: #f4f4f4; padding: 15px; border-left: 4px solid #000;'>";
echo "<p>Bienvenido de nuevo, <strong>" . $nombreusuario . "</strong>.</p>";
echo "<p>Tu ID de usuario en la base de datos es: <em>" . $Idusuario . "</em>.</p>";
echo "</div>";
?>