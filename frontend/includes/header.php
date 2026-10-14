<?php
// header.php - Encabezado global de AZKA
// Cada página define $base antes de incluirlo:
//   $base = "."   (desde frontend/)
//   $base = ".."  (desde frontend/pages/)
// $paginaActual se usa para marcar el enlace de la página en el menú.

if (!isset($base)) {
    $base = ".";
}

$paginaActual = basename($_SERVER["PHP_SELF"]);
?>
<header class="cabecera">
    <nav class="menu">

        <a href="<?php echo $base; ?>/index.php" class="logo">AZKA</a>

        <ul class="menu-lista">
            <li><a href="<?php echo $base; ?>/index.php" class="<?php echo $paginaActual == "index.php" ? "actual" : ""; ?>">INICIO</a></li>
            <li><a href="<?php echo $base; ?>/pages/catalogo.php" class="<?php echo $paginaActual == "catalogo.php" ? "actual" : ""; ?>">CATÁLOGO</a></li>
            <li><a href="<?php echo $base; ?>/pages/historia.html">HISTORIA</a></li>
            <li><a href="<?php echo $base; ?>/pages/contacto.html">CONTACTO</a></li>
        </ul>

        <div class="menu-usuario">
            <a href="<?php echo $base; ?>/backend/login.php">CUENTA</a>
            <a href="#" id="contador-carrito">CARRITO (0)</a>
        </div>

    </nav>
</header>
