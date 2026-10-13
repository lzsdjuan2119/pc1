<?php 
include 'estilo.php'; 

$nombre = isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : '';
$ingresos = isset($_POST['ingresos']) ? floatval($_POST['ingresos']) : 0;
$edad = isset($_POST['edad']) ? intval($_POST['edad']) : 0;
$tipo = isset($_POST['tipo']) ? $_POST['tipo'] : '';

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

echo "<h2 class='mb-4'>Resultado de Evaluación</h2>";
echo "<div class='card p-4 shadow-sm bg-white'>"; 
echo "<p><strong>Nombre:</strong> $nombre</p>"; 
echo "<p><strong>Edad:</strong> $edad años</p>"; 
echo "<p><strong>Ingresos:</strong> S/ " . number_format($ingresos, 2) . "</p>"; 
echo "<p><strong>Crédito solicitado:</strong> $tipo</p>"; 

if ($aprobado) { 
    echo "<div class='alert alert-success mt-3 mb-0'>El cliente califica para el crédito solicitado.</div>"; 
} else { 
    echo "<div class='alert alert-danger mt-3 mb-0'>El cliente no cumple los requisitos para este crédito.</div>"; 
} 
echo "</div>"; 
echo "<a href='index.php' class='btn btn-outline-secondary mt-3'>Realizar otra simulación</a>";

echo "</div></body></html>"; 
?>
