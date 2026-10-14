<?php
// login.php - Inicio de sesión mínimo del usuario
// Comprueba el correo y la contraseña guardados en la tabla usuarios

session_start();
require "conexion.php";

// Cerrar sesión: login.php?salir=1
if (isset($_GET["salir"])) {
    session_destroy();
    header("Location: login.php");
    exit;
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = trim($_POST["correo"] ?? "");
    $clave = $_POST["contrasena"] ?? "";

    $sql = "SELECT id_usuario, contrasena_us FROM usuarios WHERE correo_us = ?";
    $consulta = $conexion->prepare($sql);
    $consulta->execute([$correo]);
    $usuario = $consulta->fetch();

    if ($usuario && password_verify($clave, $usuario["contrasena_us"])) {
        // Guardar el usuario en la sesión
        $_SESSION["id_usuario"] = $usuario["id_usuario"];
        header("Location: ../frontend/pages/producto.php?id=1");
        exit;
    } else {
        $error = "Correo o contraseña incorrectos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AZKA - Iniciar sesión</title>
    <style>
        body { background: #080808; color: #fff; font-family: Arial, sans-serif; display: flex; justify-content: center; padding-top: 80px; }
        form { background: #17171a; padding: 30px; width: 320px; display: flex; flex-direction: column; gap: 15px; }
        h1 { font-size: 20px; letter-spacing: 3px; text-align: center; }
        input { padding: 12px; border: 1px solid #2e2e33; background: transparent; color: #fff; }
        button { padding: 12px; border: none; background: #d6243c; color: #fff; font-weight: bold; letter-spacing: 1px; cursor: pointer; }
        .error { color: #d6243c; font-size: 13px; text-align: center; }
        p { font-size: 12px; color: #9a9a9a; text-align: center; }
        a { color: #9a9a9a; font-size: 12px; text-align: center; }
        a:hover { color: #fff; }
    </style>
</head>
<body>
    <form method="post">
        <h1>AZKA</h1>

        <?php if ($error != ""): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>

        <input type="email" name="correo" placeholder="Correo" required>
        <input type="password" name="contrasena" placeholder="Contraseña" required>
        <button type="submit">INICIAR SESIÓN</button>
        <p>Prueba: ana@azka.com / 123456</p>
        <a href="../frontend/index.php">&#8592; Volver al inicio</a>
    </form>
</body>
</html>
