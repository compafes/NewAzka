// =====================================================
// AZKA - JavaScript de la página de producto
// Galería, tallas, cantidad y carrito (MySQL vía PHP)
// =====================================================

// ---------- DATOS ----------
// El id del producto llega en la URL: producto.php?id=1
var parametros = new URLSearchParams(window.location.search);
var idProducto = parseInt(parametros.get("id") || "1");

var imagenes = [];
var imagenActual = 0;
var tallaSeleccionada = "";
var cantidad = 1;
var stockMaximo = 1000; // se actualiza con el stock real de la base de datos

// Elementos de la página
var imagenGrande = document.querySelector(".foto-principal img");
var textoContador = document.querySelector(".contador");
var miniaturas = document.querySelectorAll(".miniatura-item");
var inputCantidad = document.querySelector(".numero-cantidad");
var enlaceCarrito = document.getElementById("contador-carrito");

// =====================================================
// GALERÍA DE IMÁGENES
// =====================================================

// Guarda las rutas de las miniaturas en el arreglo
for (var i = 0; i < miniaturas.length; i++) {
    imagenes.push(miniaturas[i].querySelector("img").getAttribute("src"));
}

// Cambia la imagen principal con una transición simple
function mostrarImagen(posicion) {
    if (imagenes.length == 0) {
        return; // no hay imágenes, no hace nada
    }

    // Si se pasa del final, vuelve a la primera; si no, va a la última
    if (posicion >= imagenes.length) {
        posicion = 0;
    }
    if (posicion < 0) {
        posicion = imagenes.length - 1;
    }

    imagenActual = posicion;

    // Se oculta un poco la foto, se cambia y se vuelve a mostrar
    imagenGrande.classList.add("opaca");
    setTimeout(function () {
        imagenGrande.src = imagenes[imagenActual];
        imagenGrande.classList.remove("opaca");
        textoContador.textContent = (imagenActual + 1) + " / " + imagenes.length;
    }, 300);

    // Resalta la miniatura seleccionada
    for (var i = 0; i < miniaturas.length; i++) {
        miniaturas[i].classList.remove("activa");
    }
    miniaturas[imagenActual].classList.add("activa");
}

var btnSiguiente = document.querySelector(".btn-siguiente");
var btnAnterior = document.querySelector(".btn-anterior");

if (btnSiguiente) {
    btnSiguiente.addEventListener("click", function () {
        mostrarImagen(imagenActual + 1);
    });
}

if (btnAnterior) {
    btnAnterior.addEventListener("click", function () {
        mostrarImagen(imagenActual - 1);
    });
}

// Al hacer clic en una miniatura se muestra esa imagen
for (var i = 0; i < miniaturas.length; i++) {
    miniaturas[i].addEventListener("click", function () {
        var posicion = Array.prototype.indexOf.call(miniaturas, this);
        mostrarImagen(posicion);
    });
}

// =====================================================
// CARGAR EL PRODUCTO DESDE MySQL
// =====================================================

function cargarProducto() {
    var datos = new FormData();
    datos.append("accion", "producto");
    datos.append("id_producto", idProducto);

    fetch("../backend/carrito.php", { method: "POST", body: datos })
        .then(function (respuesta) { return respuesta.json(); })
        .then(function (dato) {
            if (dato.ok) {
                // Rellenar la página con los datos reales de la base de datos
                document.querySelector(".titulo").textContent = dato.nombre;
                document.querySelector(".precio").textContent = "$" + dato.precio;
                document.querySelector(".descripcion").textContent = dato.descripcion;
                stockMaximo = dato.stock;
            } else {
                mostrarMensaje(dato.mensaje);
            }
        });
}

// =====================================================
// SISTEMA DE TALLAS
// =====================================================

// Cuando el usuario elige una talla, se guarda en la variable
var radiosTalla = document.querySelectorAll(".opciones-talla input");
for (var i = 0; i < radiosTalla.length; i++) {
    radiosTalla[i].addEventListener("change", function () {
        tallaSeleccionada = this.value;
    });
}

// =====================================================
// CONTADOR DE CANTIDAD
// =====================================================

// Aumenta cantidad (+), sin pasarse del stock
document.querySelector(".btn-mas").addEventListener("click", function () {
    if (cantidad < stockMaximo) {
        cantidad = cantidad + 1;
        inputCantidad.value = cantidad;
    } else {
        mostrarMensaje("No hay más unidades disponibles.");
    }
});

// Disminuye cantidad (−), nunca menos de 1
document.querySelector(".btn-menos").addEventListener("click", function () {
    if (cantidad > 1) {
        cantidad = cantidad - 1;
        inputCantidad.value = cantidad;
    }
});

// Si el usuario escribe directo en el campo, se valida
inputCantidad.addEventListener("change", function () {
    cantidad = parseInt(this.value);
    if (isNaN(cantidad) || cantidad < 1) {
        cantidad = 1;
    }
    if (cantidad > stockMaximo) {
        cantidad = stockMaximo;
    }
    this.value = cantidad;
});

// =====================================================
// CARRITO DE COMPRAS (MySQL vía PHP)
// =====================================================

// Actualiza el número del enlace CARRITO (0) con el carrito real
function actualizarContadorCarrito() {
    var datos = new FormData();
    datos.append("accion", "contar");

    fetch("../backend/carrito.php", { method: "POST", body: datos })
        .then(function (respuesta) { return respuesta.json(); })
        .then(function (dato) {
            enlaceCarrito.textContent = "CARRITO (" + dato.total + ")";
        });
}

// Envía el producto al PHP para guardarlo en MySQL
function agregarAlCarrito() {
    var datos = new FormData();
    datos.append("accion", "agregar");
    datos.append("id_producto", idProducto);
    datos.append("talla", tallaSeleccionada);
    datos.append("cantidad", cantidad);

    fetch("../backend/carrito.php", { method: "POST", body: datos })
        .then(function (respuesta) { return respuesta.json(); })
        .then(function (dato) {
            mostrarMensaje(dato.mensaje);
            if (dato.ok) {
                // Se usa el total que devuelve la base de datos
                enlaceCarrito.textContent = "CARRITO (" + dato.total + ")";
                // Reiniciar la cantidad después de agregar
                cantidad = 1;
                inputCantidad.value = 1;
            }
        });
}

// Muestra un mensaje de confirmación debajo del botón
function mostrarMensaje(texto) {
    var mensaje = document.querySelector(".mensaje");
    if (mensaje == null) {
        mensaje = document.createElement("p");
        mensaje.className = "mensaje";
        document.querySelector(".form-compra").appendChild(mensaje);
    }
    mensaje.textContent = texto;

    // El mensaje desaparece a los 3 segundos
    setTimeout(function () {
        mensaje.textContent = "";
    }, 3000);
}

// Al enviar el formulario se valida y se envía al PHP
document.querySelector(".form-compra").addEventListener("submit", function (evento) {
    evento.preventDefault(); // Evita que la página se recargue

    if (tallaSeleccionada == "") {
        mostrarMensaje("Primero elige una talla.");
        return;
    }

    agregarAlCarrito();
});

// Al abrir la página: cargar el producto y el contador del carrito
cargarProducto();
actualizarContadorCarrito();
