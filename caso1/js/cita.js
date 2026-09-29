// Arreglo de horarios
var horarios = ["mañana", "tarde","noche"];

// Llenar select de horarios
var select = document.getElementById("horario");
select.innerHTML = "<option value=''>-- Seleccionar --</option>";

for (var i = 0; i < horarios.length; i++) {
    if (horarios[i] == "tarde") {
        select.innerHTML += "<option value='" + horarios[i] + "' disabled>" + horarios[i] + " (No disponible)</option>";
    } else {
        select.innerHTML += "<option value='" + horarios[i] + "'>" + horarios[i] + "</option>";
    }
}
// Funcion para validar formulario
function validarFormulario(e) {
    e.preventDefault();

    // Borrar errores anteriores
    document.getElementById("error-nombre").innerHTML = "";
    document.getElementById("error-apellido").innerHTML = "";
    document.getElementById("error-email").innerHTML = "";
    document.getElementById("error-especialidad").innerHTML = "";
    document.getElementById("error-fecha").innerHTML = "";
    document.getElementById("error-horario").innerHTML = "";

    var nom = document.getElementById("nombre").value;
    var ape = document.getElementById("apellido").value;
    var correo = document.getElementById("email").value;
    var esp = document.getElementById("especialidad").value;
    var fec = document.getElementById("fecha").value;
    var hor = document.getElementById("horario").value;

    var error = 0;

    // Validar nombre
    if (nom.length < 3 || nom.length > 60) {
        document.getElementById("error-nombre").innerHTML = "El nombre debe tener de 3 a 60 caracteres";
        error = 1;
    }

    // Validar apellido
    if (ape == "") {
        document.getElementById("error-apellido").innerHTML = "Ingrese su apellido";
        error = 1;
    }

    // Validar correo
    if (correo.indexOf("@") == -1 || correo.indexOf(".") == -1) {
        document.getElementById("error-email").innerHTML = "Correo no valido";
        error = 1;
    }

    // Validar especialidad
    if (esp == "") {
        document.getElementById("error-especialidad").innerHTML = "Seleccione una especialidad";
        error = 1;
    }

    // Validar fecha
    var hoy = new Date().toISOString().split("T")[0];
    if (fec == "") {
        document.getElementById("error-fecha").innerHTML = "Seleccione una fecha";
        error = 1;
    } else if (fec < hoy) {
        document.getElementById("error-fecha").innerHTML = "La fecha no puede ser anterior a hoy";
        error = 1;
    }

    // Validar horario
    if (hor == "") {
        document.getElementById("error-horario").innerHTML = "Seleccione un horario";
        error = 1;
    } else if (hor == "tarde") {
        document.getElementById("error-horario").innerHTML = "El horario tarde no esta disponible";
        error = 1;
    }

    // Si no hay error guardar y pasar
    if (error == 0) {
        var solicitud = {
            nombre: nom + " " + ape,
            email: correo,
            especialidad: esp,
            fecha: fec,
            horario: hor
        };

        sessionStorage.setItem("solicitud", JSON.stringify(solicitud));
        window.location.href = "confirmacion-cita.html";
    }
}

// Asignar evento al formulario
document.getElementById("formCita").onsubmit = validarFormulario;

// Boton limpiar
document.getElementById("btn-limpiar").onclick = function() {
    document.getElementById("formCita").reset();
    document.getElementById("error-nombre").innerHTML = "";
    document.getElementById("error-apellido").innerHTML = "";
    document.getElementById("error-email").innerHTML = "";
    document.getElementById("error-especialidad").innerHTML = "";
    document.getElementById("error-fecha").innerHTML = "";
    document.getElementById("error-horario").innerHTML = "";
    sessionStorage.removeItem("solicitud");
};
