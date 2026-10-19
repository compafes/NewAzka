<?php
// Página de Mi Cuenta de AZKA
// Carga datos del usuario registrado y muestra sus pedidos recientes

$base = "..";

require_once __DIR__ . "/../../backend/conexion.php";

// Por ahora tomamos como ejemplo el usuario ID 1 (Ana) cargado en la base de datos
$id_usuario = 1;

// Obtener datos del usuario
$stmt_us = $conexion->prepare("SELECT * FROM usuarios WHERE id_usuario = :id");
$stmt_us->execute([':id' => $id_usuario]);
$usuario = $stmt_us->fetch(PDO::FETCH_ASSOC);

// Obtener pedidos del usuario
$stmt_ped = $conexion->prepare("SELECT * FROM pedidos WHERE id_usuario = :id ORDER BY id_pedido DESC LIMIT 3");
$stmt_ped->execute([':id' => $id_usuario]);
$pedidos = $stmt_ped->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AZKA - Mi Cuenta</title>
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/cuenta.css">
</head>
<body>

    <?php require_once __DIR__ . "/../includes/header.php"; ?>

    <main class="cuenta-container">

        <section class="cuenta-header">
            <h1>MI CUENTA</h1>
            <p class="saludo">Hola, <?php echo htmlspecialchars($usuario['nombre_us'] ?? '[Nombre]'); ?>.</p>
        </section>

        <!-- Submenú de navegación de la cuenta -->
        <div class="cuenta-nav">
            <div class="cuenta-pestañas">
                <a href="#" class="pestaña activa">PERFIL</a>
                <a href="#" class="pestaña">PEDIDOS</a>
                <a href="#" class="pestaña">DIRECCIONES</a>
            </div>
            <a href="#" class="btn-cerrar">CERRAR SESIÓN</a>
        </div>

        <div class="cuenta-grid">

            <!-- Columna Izquierda: Formulario de Mis Datos -->
            <section class="mis-datos">
                <h2>MIS DATOS</h2>
                <form action="#" method="POST" class="form-datos">
                    <div class="campo">
                        <label>NOMBRE</label>
                        <input type="text" name="nombre" value="<?php echo htmlspecialchars(($usuario['nombre_us'] ?? '') . ' ' . ($usuario['apellido_us'] ?? '')); ?>" placeholder="Nombre completo">
                    </div>

                    <div class="campo">
                        <label>CORREO</label>
                        <input type="email" name="correo" value="<?php echo htmlspecialchars($usuario['correo_us'] ?? ''); ?>" placeholder="tu@correo.com">
                    </div>

                    <div class="campo">
                        <label>TELÉFONO</label>
                        <input type="text" name="telefono" value="<?php echo htmlspecialchars($usuario['telefono_us'] ?? ''); ?>" placeholder="+000 0000 0000">
                    </div>

                    <div class="campo">
                        <label>CONTRASEÑA</label>
                        <input type="password" name="password" value="********" placeholder="********">
                    </div>

                    <button type="submit" class="btn-guardar">GUARDAR CAMBIOS</button>
                </form>
            </section>

            <!-- Columna Derecha: Tabla de Mis Pedidos -->
            <section class="mis-pedidos">
                <h2>MIS PEDIDOS</h2>

                <table class="tabla-pedidos">
                    <thead>
                        <tr>
                            <th>PEDIDO</th>
                            <th>FECHA</th>
                            <th>ESTADO</th>
                            <th>TOTAL</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($pedidos)): ?>
                            <?php foreach ($pedidos as $ped): ?>
                                <tr>
                                    <td class="id-pedido">#<?php echo str_pad($ped['id_pedido'], 4, '0', STR_PAD_LEFT); ?></td>
                                    <td><?php echo date('d/m/Y', strtotime($ped['fecha_ped'])); ?></td>
                                    <td class="estado-en-camino">En camino</td>
                                    <td>$<?php echo number_format($ped['total_ped'], 2); ?></td>
                                    <td><a href="#" class="link-ver">VER</a></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <!-- Filas de ejemplo fijas según el diseño -->
                            <tr>
                                <td class="id-pedido">#0003</td>
                                <td>00/00/2026</td>
                                <td class="estado-en-camino">En camino</td>
                                <td>$25.00</td>
                                <td><a href="#" class="link-ver">VER</a></td>
                            </tr>
                            <tr>
                                <td class="id-pedido">#0002</td>
                                <td>00/00/2026</td>
                                <td>Entregado</td>
                                <td>$50.00</td>
                                <td><a href="#" class="link-ver">VER</a></td>
                            </tr>
                            <tr>
                                <td class="id-pedido">#0001</td>
                                <td>00/00/2026</td>
                                <td>Entregado</td>
                                <td>$25.00</td>
                                <td><a href="#" class="link-ver">VER</a></td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

                <a href="#" class="ver-todos-pedidos">VER TODOS LOS PEDIDOS</a>
            </section>

        </div>

    </main>

    <?php require_once __DIR__ . "/../includes/footer.php"; ?>

</body>
</html>