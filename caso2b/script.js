// arreglo con los horarios que nos dieron
var horasDisponibles = ["09:00", "10:00", "11:00", "15:00", "16:00"];

// aca controlo la pantalla de cita.html
if (document.getElementById("formCita")) {

    // lleno el combo de horas con un bucle for
    var comboHora = document.getElementById("horario");
    comboHora.innerHTML = "<option value=''>-- Seleccionar --</option>";

    if (horasDisponibles.length == 0) {
        comboHora.innerHTML = "<option value=''>No hay horarios disponibles</option>";
    } else {
        for (var i = 0; i < horasDisponibles.length; i++) {
            var h = horasDisponibles[i];
            if (h == "11:00") {
                comboHora.innerHTML += "<option value='" + h + "'>" + h + " (No disponible)</option>";
            } else {
                comboHora.innerHTML += "<option value='" + h + "'>" + h + "</option>";
            }
        }
    }

    // si regreso de corregir vuelvo a poner lo que ya habia escrito
    if (sessionStorage.getItem("solicitud") != null) {
        var previo = JSON.parse(sessionStorage.getItem("solicitud"));
        document.getElementById("nombre").value = previo.nombre || "";
        document.getElementById("email").value = previo.email || "";
        document.getElementById("especialidad").value = previo.especialidad || "";
        document.getElementById("fecha").value = previo.fecha || "";
        document.getElementById("horario").value = previo.horario || "";
    }

    // cuando hacen click en enviar solicitud
    document.getElementById("formCita").onsubmit = function(e) {
        e.preventDefault();

        // borro todos los mensajitos de error
        document.getElementById("error-nombre").innerHTML = "";
        document.getElementById("error-email").innerHTML = "";
        document.getElementById("error-especialidad").innerHTML = "";
        document.getElementById("error-fecha").innerHTML = "";
        document.getElementById("error-horario").innerHTML = "";

        var paciente = document.getElementById("nombre").value;
        var mail = document.getElementById("email").value;
        var esp = document.getElementById("especialidad").value;
        var fec = document.getElementById("fecha").value;
        var hor = document.getElementById("horario").value;

        var fallo = 0;

        // el nombre no puede ser muy corto ni muy largo
        if (paciente.length < 3 || paciente.length > 60) {
            document.getElementById("error-nombre").innerHTML = "El nombre debe tener de 3 a 60 letras";
            fallo = 1;
        }

        // reviso si tiene arroba y punto
        if (mail.indexOf("@") == -1 || mail.indexOf(".") == -1) {
            document.getElementById("error-email").innerHTML = "Escriba un correo valido";
            fallo = 1;
        }

        // tiene que elegir especialidad
        if (esp == "") {
            document.getElementById("error-especialidad").innerHTML = "Seleccione una especialidad";
            fallo = 1;
        }

        // la fecha no puede ser del pasado
        var hoy = new Date().toISOString().split("T")[0];
        if (fec == "") {
            document.getElementById("error-fecha").innerHTML = "Seleccione una fecha";
            fallo = 1;
        } else if (fec < hoy) {
            document.getElementById("error-fecha").innerHTML = "La fecha no puede ser anterior a hoy";
            fallo = 1;
        }

        // no puede dejar la hora vacia ni elegir las 11
        if (hor == "") {
            document.getElementById("error-horario").innerHTML = "Seleccione un horario";
            fallo = 1;
        } else if (hor == "11:00") {
            document.getElementById("error-horario").innerHTML = "El horario 11:00 no esta disponible";
            fallo = 1;
        }

        // si no hubo fallas, guardo los datos y me voy a la confirmacion
        if (fallo == 0) {
            var datosCita = {
                nombre: paciente,
                email: mail,
                especialidad: esp,
                fecha: fec,
                horario: hor
            };

            sessionStorage.setItem("solicitud", JSON.stringify(datosCita));
            window.location.href = "confirmacion-cita.html";
        }
    };

    // boton para borrar todo y limpiar
    document.getElementById("btn-limpiar").onclick = function() {
        document.getElementById("formCita").reset();
        document.getElementById("error-nombre").innerHTML = "";
        document.getElementById("error-email").innerHTML = "";
        document.getElementById("error-especialidad").innerHTML = "";
        document.getElementById("error-fecha").innerHTML = "";
        document.getElementById("error-horario").innerHTML = "";
        sessionStorage.removeItem("solicitud");
    };
}

// aca controlo la segunda pantalla de confirmacion
if (document.getElementById("con-datos")) {
    var guardado = sessionStorage.getItem("solicitud");

    if (guardado == null) {
        // si se metio directo sin llenar el formulario
        document.getElementById("sin-datos").classList.remove("d-none");
    } else {
        // si hay datos los imprimo en pantalla
        document.getElementById("con-datos").classList.remove("d-none");
        var cita = JSON.parse(guardado);

        document.getElementById("resumen-nombre").innerHTML = cita.nombre;
        document.getElementById("resumen-email").innerHTML = cita.email;
        document.getElementById("resumen-especialidad").innerHTML = cita.especialidad;
        document.getElementById("resumen-fecha").innerHTML = cita.fecha;
        document.getElementById("resumen-horario").innerHTML = cita.horario;
    }

    // click al boton de confirmar cita
    document.getElementById("btn-confirmar").onclick = function() {
        document.getElementById("mensaje-exito").classList.remove("d-none");
        document.getElementById("btn-confirmar").disabled = true;
        sessionStorage.removeItem("solicitud");
    };
}
