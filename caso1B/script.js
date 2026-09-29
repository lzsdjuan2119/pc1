// lista de productos y precios
var catalogo = [
    { id: 1, nombre: "Pan de masa madre", precio: 18 },
    { id: 2, nombre: "Caja de alfajores", precio: 24 },
    { id: 3, nombre: "Torta pequeña", precio: 45 }
];

// aca controlo la primera pagina (el formulario)
if (document.getElementById("formPedido")) {

    // recorro el arreglo con un for para ponerlos en pantalla
    var contenedor = document.getElementById("contenedor-productos");
    contenedor.innerHTML = "";

    for (var i = 0; i < catalogo.length; i++) {
        var p = catalogo[i];
        contenedor.innerHTML += "<div class='border rounded p-2 mb-2 bg-white'>" +
            "<label><b>" + p.nombre + "</b> (S/ " + p.precio + ")</label>" +
            "<input type='number' id='cant" + p.id + "' class='form-control' value='0' min='0' max='10' oninput='calcular()'>" +
        "</div>";
    }

    // funcion para sacar la cuenta en vivo
    function calcular() {
        var c1 = parseInt(document.getElementById("cant1").value) || 0;
        var c2 = parseInt(document.getElementById("cant2").value) || 0;
        var c3 = parseInt(document.getElementById("cant3").value) || 0;

        var subtotal = (c1 * 18) + (c2 * 24) + (c3 * 45);

        // si llega a 100 le descuento el 10%
        var descuento = 0;
        if (subtotal >= 100) {
            descuento = subtotal * 0.10;
        }

        // si es con delivery cobra 8 soles
        var reparto = 0;
        if (document.getElementById("modalidad").value == "reparto") {
            reparto = 8;
        }

        var total = subtotal - descuento + reparto;

        // pongo los montos con dos decimales
        document.getElementById("ver-subtotal").innerHTML = subtotal.toFixed(2);
        document.getElementById("ver-descuento").innerHTML = descuento.toFixed(2);
        document.getElementById("ver-reparto").innerHTML = reparto.toFixed(2);
        document.getElementById("ver-total").innerHTML = total.toFixed(2);
    }

    document.getElementById("modalidad").onchange = calcular;

    // cuando le dan al boton de enviar pedido
    document.getElementById("formPedido").onsubmit = function(e) {
        e.preventDefault();

        // limpio los mensajitos rojos
        document.getElementById("error-nombre").innerHTML = "";
        document.getElementById("error-email").innerHTML = "";
        document.getElementById("error-fecha").innerHTML = "";
        document.getElementById("error-productos").innerHTML = "";

        var nom = document.getElementById("nombre").value;
        var correo = document.getElementById("email").value;
        var fec = document.getElementById("fecha").value;
        var mod = document.getElementById("modalidad").value;

        var error = 0;

        // que no ponga un nombre muy corto
        if (nom.length < 3 || nom.length > 60) {
            document.getElementById("error-nombre").innerHTML = "El nombre debe tener entre 3 y 60 letras";
            error = 1;
        }

        // reviso si tiene arroba y punto
        if (correo.indexOf("@") == -1 || correo.indexOf(".") == -1) {
            document.getElementById("error-email").innerHTML = "Ingrese un correo valido";
            error = 1;
        }

        // no puede pedir con fecha de ayer
        var hoy = new Date().toISOString().split("T")[0];
        if (fec == "") {
            document.getElementById("error-fecha").innerHTML = "Seleccione una fecha";
            error = 1;
        } else if (fec < hoy) {
            document.getElementById("error-fecha").innerHTML = "La fecha no puede ser anterior a hoy";
            error = 1;
        }

        // leo las cantidades que escribio
        var c1 = parseInt(document.getElementById("cant1").value) || 0;
        var c2 = parseInt(document.getElementById("cant2").value) || 0;
        var c3 = parseInt(document.getElementById("cant3").value) || 0;

        // tiene que comprar minimo una cosa
        if (c1 == 0 && c2 == 0 && c3 == 0) {
            document.getElementById("error-productos").innerHTML = "Debe elegir al menos un producto";
            error = 1;
        }

        // si no fallo nada, saco la cuenta final y mando
        if (error == 0) {
            var subtotal = (c1 * 18) + (c2 * 24) + (c3 * 45);

            var descuento = 0;
            if (subtotal >= 100) {
                descuento = subtotal * 0.10;
            }

            var reparto = 0;
            if (mod == "reparto") {
                reparto = 8;
            }

            var total = subtotal - descuento + reparto;

            // armo el texto de lo que pidio
            var listaProds = [];
            if (c1 > 0) listaProds.push(c1 + "x Pan de masa madre (S/ " + (c1 * 18) + ")");
            if (c2 > 0) listaProds.push(c2 + "x Caja de alfajores (S/ " + (c2 * 24) + ")");
            if (c3 > 0) listaProds.push(c3 + "x Torta pequeña (S/ " + (c3 * 45) + ")");

            var pedido = {
                cliente: nom,
                email: correo,
                fecha: fec,
                modalidad: (mod == "reparto" ? "Reparto a domicilio" : "Retiro en tienda"),
                productos: listaProds,
                subtotal: subtotal.toFixed(2),
                descuento: descuento.toFixed(2),
                reparto: reparto.toFixed(2),
                total: total.toFixed(2)
            };

            // lo meto al sessionStorage y salto a la otra pagina
            sessionStorage.setItem("pedido", JSON.stringify(pedido));
            window.location.href = "resumen-pedido.html";
        }
    };

    // boton para borrar todo y dejar en cero
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

// aca la segunda pagina para el resumen
if (document.getElementById("con-datos")) {
    var datos = sessionStorage.getItem("pedido");

    if (datos == null) {
        // si se mete de frente sin llenar nada le muestro el aviso
        document.getElementById("sin-datos").classList.remove("d-none");
    } else {
        // si hay datos los muestro en pantalla
        document.getElementById("con-datos").classList.remove("d-none");
        var obj = JSON.parse(datos);

        document.getElementById("resumen-nombre").innerHTML = obj.cliente;
        document.getElementById("resumen-email").innerHTML = obj.email;
        document.getElementById("resumen-fecha").innerHTML = obj.fecha;
        document.getElementById("resumen-modalidad").innerHTML = obj.modalidad;

        // pego los productos en la lista
        var ul = document.getElementById("resumen-productos");
        ul.innerHTML = "";
        for (var k = 0; k < obj.productos.length; k++) {
            ul.innerHTML += "<li class='list-group-item'>" + obj.productos[k] + "</li>";
        }

        document.getElementById("resumen-subtotal").innerHTML = obj.subtotal;
        document.getElementById("resumen-descuento").innerHTML = obj.descuento;
        document.getElementById("resumen-reparto").innerHTML = obj.reparto;
        document.getElementById("resumen-total").innerHTML = obj.total;
    }

    // click al boton de confirmar
    document.getElementById("btn-confirmar").onclick = function() {
        document.getElementById("mensaje-exito").classList.remove("d-none");
        document.getElementById("btn-confirmar").disabled = true;
        sessionStorage.removeItem("pedido");
    };
}
