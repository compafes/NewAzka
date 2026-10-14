<?php
// Página de inicio de AZKA
// Usa el header y footer globales desde frontend/includes/

$base = ".";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AZKA - Inicio</title>
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>

    <?php require_once __DIR__ . "/includes/header.php"; ?>

    <main>
        <section class="banner">

            <div class="banner-imagen activa">
                <img src="img/IMAGEN 1.png" alt="Prenda de la colección AZKA">
            </div>
            <div class="banner-imagen">
                <img src="img/IMAGEN 8.png" alt="Prendas de la colección AZKA">
            </div>
            <div class="banner-imagen">
                <img src="img/IMAGEN 15.png" alt="Detalle de la colección AZKA">
            </div>

            <div class="banner-contenido">
                <span class="etiqueta">DROP 02</span>
                <h1 class="banner-titulo">AZKA</h1>
                <a href="pages/catalogo.php" class="btn">VER COLECCIÓN</a>
            </div>

        </section>



        <section class="drop">
            <div class="drop-cabecera">
                <h2>LATEST DROP</h2>
                <a href="pages/catalogo.php" class="ver-todo">VER TODO &#8594;</a>
            </div>

            <div class="tarjetas">

                <article class="tarjeta">
                    <a href="pages/producto.php?id=1" class="tarjeta-enlace">
                        <div class="tarjeta-foto">
                            <img src="img/IMAGEN 1.png" alt="Camiseta AZKA">
                            <span class="estado disponible">DISPONIBLE</span>
                        </div>
                        <div class="tarjeta-info">
                            <h3>CAMISETA AZKA</h3>
                            <p class="tarjeta-precio">$25.00</p>
                        </div>
                    </a>
                </article>

                <!-- Datos de prueba desde aquí -->
                <article class="tarjeta">
                    <a href="pages/producto.php?id=2" class="tarjeta-enlace">
                        <div class="tarjeta-foto">
                            <img src="img/IMAGEN 8.png" alt="Hoodie AZKA">
                            <span class="estado demo">PREVENTA</span>
                        </div>
                        <div class="tarjeta-info">
                            <h3>HOODIE AZKA</h3>
                            <p class="tarjeta-precio">$45.00</p>
                        </div>
                    </a>
                </article>

                <article class="tarjeta">
                    <a href="pages/producto.php?id=3" class="tarjeta-enlace">
                        <div class="tarjeta-foto">
                            <img src="img/IMAGEN 3.png" alt="Pantalón AZKA">
                            <span class="estado demo">DEMO</span>
                        </div>
                        <div class="tarjeta-info">
                            <h3>PANTALÓN AZKA</h3>
                            <p class="tarjeta-precio">$40.00</p>
                        </div>
                    </a>
                </article>

                <article class="tarjeta">
                    <a href="pages/producto.php?id=4" class="tarjeta-enlace">
                        <div class="tarjeta-foto">
                            <img src="img/IMAGEN 15.png" alt="Gorra AZKA">
                            <span class="estado demo">DEMO</span>
                        </div>
                        <div class="tarjeta-info">
                            <h3>GORRA AZKA</h3>
                            <p class="tarjeta-precio">$18.00</p>
                        </div>
                    </a>
                </article>

            </div>
        </section>

    </main>

    <?php require_once __DIR__ . "/includes/footer.php"; ?>

</body>
</html>
    