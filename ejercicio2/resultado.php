<?php
$nombre = $_POST['nombre'];
$edad = $_POST['edad'];
$vacuna = $_POST['vacuna'];
// Evaluación según vacuna y edad
$apto = false;
switch ($vacuna) {
    case 'Influenza':
        if ($edad >= 60) $apto = true;
        break;
    case 'Sarampion':
        if ($edad >= 5 && $edad <= 12) $apto = true;
        break;
    case 'COVID-19':
        if ($edad >= 18) $apto = true;
        break;
    case 'Hepatitis B':
        if ($edad >= 1) $apto = true;
        break;
}
echo "<h2>Resultado de Evaluación</h2>";
echo "<p><strong>Nombre:</strong> $nombre</p>";
echo "<p><strong>Edad:</strong> $edad años</p>";
echo "<p><strong>Vacuna solicitada:</strong> $vacuna</p>";
if ($apto) {
    echo "<p style='color:green;'><strong>Resultado:</strong> El paciente es apto para recibir la vacuna.</p>";
} else {
    echo "<p style='color:red;'><strong>Resultado:</strong> El paciente no cumple con la edad requerida para esta vacuna.</p>";
}
?>
