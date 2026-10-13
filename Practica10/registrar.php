<?php
if (isset($_POST['producto'], $_POST['cantidad'], $_POST['precio'], $_POST['pais'])) {
    $linea = trim($_POST['producto']) . "," . floatval($_POST['cantidad']) . "," . floatval($_POST['precio']) . "," . trim($_POST['pais']) . "\n";
    file_put_contents('exportaciones.txt', $linea, FILE_APPEND);
}
header("Location: reporte.php");
exit;
