<?php
if (isset($_POST['nombre'], $_POST['nota'])) {
    $linea = trim($_POST['nombre']) . "," . floatval($_POST['nota']) . "
";
    file_put_contents('estudiantes.txt', $linea, FILE_APPEND);
}
header("Location: reporte.php");
exit;
