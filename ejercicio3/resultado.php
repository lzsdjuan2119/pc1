<?php include 'estilo.php'; ?>
<h2 class="mb-4">Resultado de Evaluación</h2>
<?php
$nombre = $_POST['nombre'];
$edad = $_POST['edad'];
$ingresos = $_POST['ingresos'];
$tipo = $_POST['tipo'];
$aprobado = false;
switch ($tipo) {
    case 'Personal':
        if ($ingresos >= 1200 && $edad >= 21) $aprobado = true;
        break;
    case 'Vehicular':
        if ($ingresos >= 2500 && $edad >= 23) $aprobado = true;
        break;
    case 'Hipotecario':
        if ($ingresos >= 3500 && $edad >= 25) $aprobado = true;
        break;
}
echo "<div class='card p-4'>";
echo "<p><strong>Nombre:</strong> $nombre</p>";
echo "<p><strong>Edad:</strong> $edad años</p>";
echo "<p><strong>Ingresos:</strong> S/ $ingresos</p>";
echo "<p><strong>Crédito solicitado:</strong> $tipo</p>";
if ($aprobado) {
    echo "<div class='alert alert-success mt-3'>El cliente califica para el crédito solicitado.</div>";
} else {
    echo "<div class='alert alert-danger mt-3'>El cliente no cumple los requisitos para este crédito.</div>";
}
echo "</div>";
echo "</div></body></html>";
?>
