<?php
// carrito.php - Operaciones del carrito con MySQL
// Recibe peticiones desde JavaScript (fetch) y responde en JSON

session_start();
require "conexion.php";

header("Content-Type: application/json; charset=utf-8");

$accion = $_POST["accion"] ?? "";

// ---------------------------------------------------
// ACCIÓN: contar las unidades del carrito del usuario
// ---------------------------------------------------
if ($accion == "contar") {
    $total = 0;

    if (isset($_SESSION["id_usuario"])) {
        $sql = "SELECT COALESCE(SUM(cantidad_car), 0) AS total FROM carrito WHERE id_usuario = ?";
        $consulta = $conexion->prepare($sql);
        $consulta->execute([$_SESSION["id_usuario"]]);
        $total = (int) $consulta->fetch()["total"];
    }

    echo json_encode(["total" => $total]);
    exit;
}

// ---------------------------------------------------
// ACCIÓN: devolver los datos reales del producto
// ---------------------------------------------------
if ($accion == "producto") {
    $id_producto = filter_input(INPUT_POST, "id_producto", FILTER_VALIDATE_INT);

    if (!$id_producto) {
        echo json_encode(["ok" => false, "mensaje" => "Producto no válido."]);
        exit;
    }

    $sql = "SELECT nombre_prod, precio_prod, stock_prod, descripcion_prod FROM productos WHERE id_producto = ?";
    $consulta = $conexion->prepare($sql);
    $consulta->execute([$id_producto]);
    $producto = $consulta->fetch();

    if (!$producto) {
        echo json_encode(["ok" => false, "mensaje" => "Producto no encontrado."]);
        exit;
    }

    echo json_encode([
        "ok" => true,
        "nombre" => $producto["nombre_prod"],
        "precio" => $producto["precio_prod"],
        "stock" => (int) $producto["stock_prod"],
        "descripcion" => $producto["descripcion_prod"]
    ]);
    exit;
}

// ---------------------------------------------------
// ACCIÓN: agregar un producto al carrito
// ---------------------------------------------------
if ($accion == "agregar") {

    // 1) Debe existir una sesión de usuario válida
    if (!isset($_SESSION["id_usuario"])) {
        echo json_encode(["ok" => false, "mensaje" => "Debes iniciar sesión para agregar productos."]);
        exit;
    }
    $id_usuario = $_SESSION["id_usuario"];

    // 2) Validar los datos enviados por el navegador
    $id_producto = filter_input(INPUT_POST, "id_producto", FILTER_VALIDATE_INT);
    $talla = $_POST["talla"] ?? "";
    $cantidad = filter_input(INPUT_POST, "cantidad", FILTER_VALIDATE_INT);
    $tallasValidas = ["S", "M", "L", "XL"];

    if (!$id_producto || !in_array($talla, $tallasValidas) || !$cantidad || $cantidad < 1) {
        echo json_encode(["ok" => false, "mensaje" => "Datos inválidos. Revisa talla y cantidad."]);
        exit;
    }

    // 3) Consultar el producto REAL en la base de datos
    //    (el precio y el stock no llegan del navegador)
    $sql = "SELECT nombre_prod, stock_prod FROM productos WHERE id_producto = ?";
    $consulta = $conexion->prepare($sql);
    $consulta->execute([$id_producto]);
    $producto = $consulta->fetch();

    if (!$producto) {
        echo json_encode(["ok" => false, "mensaje" => "El producto no existe."]);
        exit;
    }

    // 4) Verificar que haya stock suficiente
    if ($producto["stock_prod"] < $cantidad) {
        echo json_encode(["ok" => false, "mensaje" => "No hay suficiente stock disponible."]);
        exit;
    }

    // 5) Verificar si el mismo producto y talla ya están en el carrito
    $sql = "SELECT cantidad_car FROM carrito WHERE id_usuario = ? AND id_producto = ? AND talla_car = ?";
    $consulta = $conexion->prepare($sql);
    $consulta->execute([$id_usuario, $id_producto, $talla]);
    $existente = $consulta->fetch();

    if ($existente) {
        // Ya existe: se suma la cantidad sin pasar del stock
        $cantidadNueva = $existente["cantidad_car"] + $cantidad;
        if ($cantidadNueva > $producto["stock_prod"]) {
            $cantidadNueva = $producto["stock_prod"];
        }

        $sql = "UPDATE carrito SET cantidad_car = ?, fecha_car = NOW() WHERE id_usuario = ? AND id_producto = ? AND talla_car = ?";
        $consulta = $conexion->prepare($sql);
        $consulta->execute([$cantidadNueva, $id_usuario, $id_producto, $talla]);
    } else {
        // Producto nuevo en el carrito
        $sql = "INSERT INTO carrito (id_usuario, id_producto, talla_car, cantidad_car) VALUES (?, ?, ?, ?)";
        $consulta = $conexion->prepare($sql);
        $consulta->execute([$id_usuario, $id_producto, $talla, $cantidad]);
    }

    // 6) Devolver el total de unidades para el contador del menú
    $sql = "SELECT COALESCE(SUM(cantidad_car), 0) AS total FROM carrito WHERE id_usuario = ?";
    $consulta = $conexion->prepare($sql);
    $consulta->execute([$id_usuario]);
    $total = (int) $consulta->fetch()["total"];

    echo json_encode([
        "ok" => true,
        "mensaje" => "Producto agregado al carrito. Talla: " . $talla,
        "total" => $total
    ]);
    exit;
}

// Acción desconocida
echo json_encode(["ok" => false, "mensaje" => "Acción no válida."]);
