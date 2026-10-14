<?php
// Página de detalle de producto de AZKA
// Usa el header y footer globales desde frontend/includes/

$base = "..";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AZKA - Detalle de producto</title>
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/producto.css">
</head>
<body>

    <?php require_once __DIR__ . "/../includes/header.php"; ?>

    <main class="contenido">

        <section class="producto">
            <section class="galeria">

                <!-- Miniaturas verticales -->
                <ul class="miniaturas">
                    <li class="miniatura-item activa">
                        <img src="../img/IMAGEN 1.png" alt="Vista 1 de la prenda">
                    </li>
                    <li class="miniatura-item">
                        <img src="../img/IMAGEN 8.png" alt="Vista 2 de la prenda">
                    </li>
                    <li class="miniatura-item">
                        <img src="../img/IMAGEN 3.png" alt="Vista 3 de la prenda">
                    </li>
                    <li class="miniatura-item">
                        <img src="../img/IMAGEN 15.png" alt="Vista 4 de la prenda">
                    </li>
                </ul>

                <!-- Imagen principal grande -->
                <figure class="foto-principal">
                    <button type="button" class="btn-anterior" aria-label="Imagen anterior">&#10094;</button>
                    <img src="../img/IMAGEN 1.png" alt="Imagen principal de la prenda" width="620" height="775">
                    <button type="button" class="btn-siguiente" aria-label="Imagen siguiente">&#10095;</button>
                    <figcaption class="contador">1 / 4</figcaption>
                </figure>

            </section>

            <!-- ----------  Información del producto ---------- -->
            <article class="info-producto">

                <!-- Etiqueta de novedad -->
                <span class="etiqueta">NUEVO</span>

                <!-- Título y precio -->
                <h1 class="titulo">NOMBRE DE LA PRENDA</h1>
                <p class="precio">$25.00</p>
                <hr>

                <!-- Descripción corta -->
                <p class="descripcion">aqui va la descripción corta de la prenda</p>

                <!-- Formulario de compra -->
                <form class="form-compra" action="#" method="post">

                    <!-- Talla -->
                    <div class="campo-talla">
                        <div class="campo-cabecera">
                            <h2 class="campo-titulo">TALLA</h2>
                            <a href="tallas.html" class="guia-tallas">GUÍA DE TALLAS</a>
                        </div>
                        <div class="opciones-talla">
                            <input type="radio" name="talla" id="talla-s" value="S">
                            <label for="talla-s">S</label>

                            <input type="radio" name="talla" id="talla-m" value="M">
                            <label for="talla-m">M</label>

                            <input type="radio" name="talla" id="talla-l" value="L">
                            <label for="talla-l">L</label>

                            <input type="radio" name="talla" id="talla-xl" value="XL" disabled>
                            <label for="talla-xl">XL</label>
                        </div>
                        <p class="aviso">Quedan pocas unidades.</p>
                    </div>

                    <!-- Cantidad -->
                    <div class="campo-cantidad">
                        <h2 class="campo-titulo">CANTIDAD</h2>
                        <div class="control-cantidad">
                            <button type="button" class="btn-menos" aria-label="Reducir cantidad">&minus;</button>
                            <input type="number" class="numero-cantidad" value="1" min="1">
                            <button type="button" class="btn-mas" aria-label="Aumentar cantidad">+</button>
                        </div>
                    </div>

                    <!-- Boton de compra -->
                    <button type="submit" class="btn-carrito">AGREGAR AL CARRITO</button>
                </form>
            </article>
        </section>
    </main>

    <?php require_once __DIR__ . "/../includes/footer.php"; ?>

    <!-- JavaScript de la página de producto -->
    <script src="../js/producto.js"></script>

</body>
</html>
