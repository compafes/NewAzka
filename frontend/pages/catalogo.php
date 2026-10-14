<?php
// Página de catálogo de AZKA
// Usa el header y footer globales desde frontend/includes/
// Muestra los productos reales de la base de datos. Los espacios que
// todavía no tienen producto registrado son ejemplos del diseño (DEMO).

$base = "..";

// Conectar a la base de datos y traer los productos registrados
require_once __DIR__ . "/../../backend/conexion.php";

$sql = "SELECT id_producto, nombre_prod, precio_prod, imagen_prod FROM productos ORDER BY id_producto";
$consulta = $conexion->query($sql);
$productos = $consulta->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AZKA - Catálogo</title>
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/catalogo.css">
</head>
<body>

    <?php require_once __DIR__ . "/../includes/header.php"; ?>

    <main class="catalogo">

        <h1>CATÁLOGO</h1>
        <p class="catalogo-intro">Todas las prendas disponibles.</p>

        <!-- Categorías: por ahora solo se muestran, todavía no filtran -->
        <div class="categorias">
            <span class="activa">TODOS</span>
            <span>CAMISETAS</span>
            <span>HOODIES</span>
            <span>PANTALONES</span>
            <span>ACCESORIOS</span>
        </div>

        <section class="productos">

            <!-- Productos reales desde la base de datos -->
            <?php foreach ($productos as $producto): ?>
                <article class="producto">
                    <a href="producto.php?id=<?php echo $producto["id_producto"]; ?>">
                        <div class="producto-foto">
                            <img src="../img/<?php echo htmlspecialchars($producto["imagen_prod"]); ?>" alt="<?php echo htmlspecialchars($producto["nombre_prod"]); ?>">
                        </div>
                        <div class="producto-info">
                            <h3><?php echo htmlspecialchars($producto["nombre_prod"]); ?></h3>
                            <p class="producto-precio">$<?php echo $producto["precio_prod"]; ?></p>
                        </div>
                    </a>
                </article>
            <?php endforeach; ?>

            <!-- Espacios de ejemplo del diseño mientras no hay más productos -->
            <!-- (los mismos también aparecen en la página de inicio) -->
            <article class="producto">
                <div class="producto-foto">
                    <img src="../img/IMAGEN 8.png" alt="Hoodie AZKA">
                    <span class="estado demo">DEMO</span>
                </div>
                <div class="producto-info">
                    <h3>HOODIE AZKA</h3>
                    <p class="producto-precio">$45.00</p>
                </div>
            </article>

            <article class="producto">
                <div class="producto-foto">
                    <img src="../img/IMAGEN 3.png" alt="Pantalón AZKA">
                    <span class="estado demo">DEMO</span>
                </div>
                <div class="producto-info">
                    <h3>PANTALÓN AZKA</h3>
                    <p class="producto-precio">$40.00</p>
                </div>
            </article>

            <article class="producto">
                <div class="producto-foto">
                    <img src="../img/IMAGEN 15.png" alt="Gorra AZKA">
                    <span class="estado demo">DEMO</span>
                </div>
                <div class="producto-info">
                    <h3>GORRA AZKA</h3>
                    <p class="producto-precio">$18.00</p>
                </div>
            </article>

            <!-- Espacios vacíos del diseño original -->
            <article class="producto">
                <div class="producto-foto foto-vacia">FOTO 300 x 375</div>
                <div class="producto-info">
                    <h3>NOMBRE DE PRENDA</h3>
                    <p class="producto-precio">$25.00</p>
                </div>
            </article>

            <article class="producto">
                <div class="producto-foto foto-vacia">FOTO 300 x 375</div>
                <div class="producto-info">
                    <h3>NOMBRE DE PRENDA</h3>
                    <p class="producto-precio">$25.00</p>
                </div>
            </article>

            <article class="producto">
                <div class="producto-foto foto-vacia">FOTO 300 x 375</div>
                <div class="producto-info">
                    <h3>NOMBRE DE PRENDA</h3>
                    <p class="producto-precio">$25.00</p>
                </div>
            </article>

            <article class="producto">
                <div class="producto-foto foto-vacia">FOTO 300 x 375</div>
                <div class="producto-info">
                    <h3>NOMBRE DE PRENDA</h3>
                    <p class="producto-precio">$25.00</p>
                </div>
            </article>

        </section>

        <!-- Botón del diseño original: por ahora no carga más productos -->
        <button type="button" class="btn-ver-mas">VER MÁS</button>

    </main>

    <?php require_once __DIR__ . "/../includes/footer.php"; ?>

</body>
</html>
