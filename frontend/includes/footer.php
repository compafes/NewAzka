<?php
if (!isset($base)) {
    $base = ".";
}
?>
<footer class="pie">
    <div class="pie-columnas">

        <div class="pie-columna">
            <p class="pie-logo">AZKA</p>
            <p>Ropa streetwear con identidad propia.</p>
        </div>

        <div class="pie-columna">
            <h4>TIENDA</h4>
            <a href="<?php echo $base; ?>/pages/catalogo.php">Catálogo</a>
            <a href="<?php echo $base; ?>/pages/producto.php?id=1">Destacado</a>
        </div>

        <div class="pie-columna">
            <h4>SOPORTE</h4>
            <a href="<?php echo $base; ?>/pages/contacto.html">Contacto</a>
        </div>

        <div class="pie-columna">
            <h4>CUENTA</h4>
            <a href="<?php echo $base; ?>/backend/login.php">Iniciar sesión</a>
        </div>

        <div class="pie-columna">
            <h4>COMUNIDAD</h4>
            <a href="<?php echo $base; ?>/pages/historia.html">Historia</a>
        </div>

    </div>
    <p class="pie-copy">&copy; 2026 AZKA. Todos los derechos reservados.</p>
</footer>
