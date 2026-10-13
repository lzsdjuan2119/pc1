<?php
if (isset($_POST['producto'], $_POST['cantidad'], $_POST['precio'], $_POST['pais'])) {
    $producto = trim($_POST['producto']);
    $cantidad = floatval($_POST['cantidad']);
    $precio = floatval($_POST['precio']);
    $pais = trim($_POST['pais']);

    if ($producto !== "" && $cantidad > 0 && $precio > 0 && $pais !== "") {
        $linea = $producto . "," . $cantidad . "," . $precio . "," . $pais . "\n";
        file_put_contents('exportaciones.txt', $linea, FILE_APPEND);
    }
}
header("Location: reporte.php");
exit;
