<?php
// index.php
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Prueba de Inclusión en PHP</title>
</head>
<body>

    <!-- Aquí conectamos el archivo cabecera.php -->
   
    <main style="padding: 20px; font-family: sans-serif;">
        <h1>Página Principal</h1>
        <p>Este texto pertenece exclusivamente al archivo index.php, pero arriba se ha incrustado la cabecera de forma dinámica.</p>
    </main>
 <?php include 'cabecera.php'; ?>

</body>
</html>