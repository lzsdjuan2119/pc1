// productos que vende la panaderia con sus precios
var listaProductos = [
    { codigo: 1, nombre: "Pan de masa madre", precio: 18 },
    { codigo: 2, nombre: "Caja de alfajores", precio: 24 },
    { codigo: 3, nombre: "Torta pequeña", precio: 45 }
];

// controlo la pantalla de pedido.html
if (document.getElementById("formPedido")) {

    // meto los productos al html usando un for
    var cajaProds = document.getElementById("contenedor-productos");
    cajaProds.innerHTML = "";

    for (var i = 0; i < listaProductos.length; i++) {
        var item = listaProductos[i];
        cajaProds.innerHTML += "<div class='border rounded p-2 mb-2 bg-white'>" +
            "<label><b>" + item.nombre + "</b> (S/ " + item.precio + ")</label>" +
            "<input type='number' id='prod" + item.codigo + "' class='form-control' value='0' min='0' max='10' oninput='calcularCuenta()'>" +
        "</div>";
    }

    // funcion simple para calcular cuanto va a pagar
    function calcularCuenta() {
        var q1 = parseInt(document.getElementById("prod1").value) || 0;
        var q2 = parseInt(document.getElementById("prod2").value) || 0;
        var q3 = parseInt(document.getElementById("prod3").value) || 0;

        var subtotal = (q1 * 18) + (q2 * 24) + (q3 * 45);

        // si la compra llega a 100 le rebajo el 10%
        var descuento = 0;
        if (subtotal >= 100) {
            descuento = subtotal * 0.10;
        }

        // delivery cobra 8 soles si no es retiro
        var envio = 0;
        if (document.getElementById("modalidad").value == "reparto") {
            envio = 8;
        }

        var total = subtotal - descuento + envio;

        // muestro los montos con decimales
        document.getElementById("ver-subtotal").innerHTML = subtotal.toFixed(2);
        document.getElementById("ver-descuento").innerHTML = descuento.toFixed(2);
        document.getElementById("ver-reparto").innerHTML = envio.toFixed(2);
        document.getElementById("ver-total").innerHTML = total.toFixed(2);
    }

    document.getElementById("modalidad").onchange = calcularCuenta;

    // si regresa de corregir pedido vuelvo a poner lo que ya habia escrito
    if (sessionStorage.getItem("pedido") != null) {
        var previo = JSON.parse(sessionStorage.getItem("pedido"));
        document.getElementById("nombre").value = previo.cliente || "";
        document.getElementById("email").value = previo.email || "";
        document.getElementById("fecha").value = previo.fecha || "";
        document.getElementById("modalidad").value = (previo.modalidad == "Reparto a domicilio" ? "reparto" : "retiro");
        if (previo.cantidades) {
            document.getElementById("prod1").value = previo.cantidades[0] || 0;
            document.getElementById("prod2").value = previo.cantidades[1] || 0;
            document.getElementById("prod3").value = previo.cantidades[2] || 0;
        }
        calcularCuenta();
    }

    // al hacer click en enviar
    document.getElementById("formPedido").onsubmit = function(e) {
        e.preventDefault();

        // borro los textos de error
        document.getElementById("error-nombre").innerHTML = "";
        document.getElementById("error-email").innerHTML = "";
        document.getElementById("error-fecha").innerHTML = "";
        document.getElementById("error-productos").innerHTML = "";

        var cli = document.getElementById("nombre").value;
        var em = document.getElementById("email").value;
        var fe = document.getElementById("fecha").value;
        var mo = document.getElementById("modalidad").value;

        var hayFallo = 0;

        // nombre entre 3 y 60 caracteres
        if (cli.length < 3 || cli.length > 60) {
            document.getElementById("error-nombre").innerHTML = "El nombre debe tener entre 3 y 60 letras";
            hayFallo = 1;
        }

        // correo con @ y .
        if (em.indexOf("@") == -1 || em.indexOf(".") == -1) {
            document.getElementById("error-email").innerHTML = "Debe ser un correo valido";
            hayFallo = 1;
        }

        // fecha no anterior a hoy
        var hoy = new Date().toISOString().split("T")[0];
        if (fe == "") {
            document.getElementById("error-fecha").innerHTML = "Elija una fecha";
            hayFallo = 1;
        } else if (fe < hoy) {
            document.getElementById("error-fecha").innerHTML = "No puede ser una fecha pasada";
            hayFallo = 1;
        }

        // leo las cantidades
        var q1 = parseInt(document.getElementById("prod1").value) || 0;
        var q2 = parseInt(document.getElementById("prod2").value) || 0;
        var q3 = parseInt(document.getElementById("prod3").value) || 0;

        // validar que pida minimo 1 unidad
        if (q1 == 0 && q2 == 0 && q3 == 0) {
            document.getElementById("error-productos").innerHTML = "Debe elegir al menos un producto";
            hayFallo = 1;
        }

        // si todo esta bien, calculo y guardo
        if (hayFallo == 0) {
            var subtotal = (q1 * 18) + (q2 * 24) + (q3 * 45);

            var descuento = 0;
            if (subtotal >= 100) {
                descuento = subtotal * 0.10;
            }

            var envio = 0;
            if (mo == "reparto") {
                envio = 8;
            }

            var total = subtotal - descuento + envio;

            // armo los items que compro
            var itemsElegidos = [];
            if (q1 > 0) itemsElegidos.push(q1 + "x Pan de masa madre (S/ " + (q1 * 18) + ")");
            if (q2 > 0) itemsElegidos.push(q2 + "x Caja de alfajores (S/ " + (q2 * 24) + ")");
            if (q3 > 0) itemsElegidos.push(q3 + "x Torta pequeña (S/ " + (q3 * 45) + ")");

            var datosGuardar = {
                cliente: cli,
                email: em,
                fecha: fe,
                modalidad: (mo == "reparto" ? "Reparto a domicilio" : "Retiro en tienda"),
                productos: itemsElegidos,
                cantidades: [q1, q2, q3],
                subtotal: subtotal.toFixed(2),
                descuento: descuento.toFixed(2),
                reparto: envio.toFixed(2),
                total: total.toFixed(2)
            };

            // paso los datos al sessionStorage y cambio de pagina
            sessionStorage.setItem("pedido", JSON.stringify(datosGuardar));
            window.location.href = "resumen-pedido.html";
        }
    };

    // boton limpiar
    document.getElementById("btn-limpiar").onclick = function() {
        document.getElementById("formPedido").reset();
        document.getElementById("error-nombre").innerHTML = "";
        document.getElementById("error-email").innerHTML = "";
        document.getElementById("error-fecha").innerHTML = "";
        document.getElementById("error-productos").innerHTML = "";
        document.getElementById("ver-subtotal").innerHTML = "0.00";
        document.getElementById("ver-descuento").innerHTML = "0.00";
        document.getElementById("ver-reparto").innerHTML = "0.00";
        document.getElementById("ver-total").innerHTML = "0.00";
        sessionStorage.removeItem("pedido");
    };
}

// controlo la pantalla de resumen-pedido.html
if (document.getElementById("con-datos")) {
    var guardado = sessionStorage.getItem("pedido");

    if (guardado == null) {
        // si entra directo sin llenar nada
        document.getElementById("sin-datos").classList.remove("d-none");
    } else {
        // si hay datos los pinto
        document.getElementById("con-datos").classList.remove("d-none");
        var p = JSON.parse(guardado);

        document.getElementById("resumen-nombre").innerHTML = p.cliente;
        document.getElementById("resumen-email").innerHTML = p.email;
        document.getElementById("resumen-fecha").innerHTML = p.fecha;
        document.getElementById("resumen-modalidad").innerHTML = p.modalidad;

        // pinto la lista de lo que compro
        var ul = document.getElementById("resumen-productos");
        ul.innerHTML = "";
        for (var k = 0; k < p.productos.length; k++) {
            ul.innerHTML += "<li class='list-group-item'>" + p.productos[k] + "</li>";
        }

        document.getElementById("resumen-subtotal").innerHTML = p.subtotal;
        document.getElementById("resumen-descuento").innerHTML = p.descuento;
        document.getElementById("resumen-reparto").innerHTML = p.reparto;
        document.getElementById("resumen-total").innerHTML = p.total;
    }

    // click para confirmar pedido
    document.getElementById("btn-confirmar").onclick = function() {
        document.getElementById("mensaje-exito").classList.remove("d-none");
        document.getElementById("btn-confirmar").disabled = true;
        sessionStorage.removeItem("pedido");
    };
}
