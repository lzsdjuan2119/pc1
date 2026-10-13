<?php
if (isset($_POST['nombre']) && isset($_POST['asistencia']) && isset($_POST['notas'])) {
    $nombre = $_POST['nombre'];
    $asistencia = $_POST['asistencia'];
    $notas = $_POST['notas'];

    // Calcular promedio
    $suma = array_sum($notas);
    $cantidad = count($notas);
    $promedio = $suma / $cantidad;

    // Mostrar resultados
    echo "<h2>Resultado final de $nombre</h2>";
    echo "<p><strong>Promedio:</strong> " . round($promedio, 2) . "</p>";
    echo "<p><strong>Asistencia:</strong> $asistencia%</p>";

    if ($promedio >= 13 && $asistencia >= 70) {
        echo "<p style='color:green;'><strong>Estado:</strong> Aprobado</p>";
    } elseif ($promedio >= 13 && $asistencia < 70) {
        echo "<p style='color:orange;'><strong>Estado:</strong> Desaprobado por laura</p>";
    } else {
        echo "<p style='color:red;'><strong>Estado:</strong> Igual de burro que Laura</p>";
    }
} else {
    echo "<p>Error: No se recibieron los datos del formulario.</p>";
}
