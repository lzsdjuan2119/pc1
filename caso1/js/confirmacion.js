// Obtener datos guardados
var datos = sessionStorage.getItem("solicitud");

if (datos == null) {
    // Si no hay datos (ingreso directo)
    document.getElementById("sin-datos").classList.remove("d-none");
} else {
    // Si hay datos mostrar resumen
    document.getElementById("con-datos").classList.remove("d-none");

    var obj = JSON.parse(datos);

    document.getElementById("resumen-nombre").innerHTML = obj.nombre;
    document.getElementById("resumen-email").innerHTML = obj.email;
    document.getElementById("resumen-especialidad").innerHTML = obj.especialidad;
    document.getElementById("resumen-fecha").innerHTML = obj.fecha;
    document.getElementById("resumen-horario").innerHTML = obj.horario;
}

// Boton confirmar
document.getElementById("btn-confirmar").onclick = function() {
    document.getElementById("mensaje-exito").classList.remove("d-none");
    document.getElementById("btn-confirmar").disabled = true;
    sessionStorage.removeItem("solicitud");
};
