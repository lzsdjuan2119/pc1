<?php include 'estilo.php'; ?>
<h2 class="mb-4">Inventario actualizado</h2>
<?php
$archivo = 'productos.txt';
// Registrar nuevo producto
if (isset($_POST['nombre'], $_POST['precio'], $_POST['stock'])) {
    $linea = $_POST['nombre'] . ',' . $_POST['precio'] . ',' . $_POST['stock'] . "
";
    file_put_contents($archivo, $linea, FILE_APPEND); // Agrega línea al archivo
}
// Leer todos los productos del archivo
$productos = [];
if (file_exists($archivo)) {
    $lineas = file($archivo, FILE_IGNORE_NEW_LINES);
    foreach ($lineas as $linea) {
        list($nombre, $precio, $stock) = explode(",", $linea);
        $productos[] = [
            "nombre" => $nombre,
            "precio" => floatval($precio),
            "stock" => intval($stock)
        ];
    }
}
?>
<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>Producto</th>
            <th>Precio (S/)</th>
            <th>Stock</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($productos as $p): ?>
            <tr>
                <td><?php echo $p["nombre"]; ?></td>
                <td>S/ <?php echo $p["precio"]; ?></td>
                <td><?php echo $p["stock"]; ?></td>
                <td>
                    <?php
                    if ($p["stock"] == 0) {
                        echo "<span class='text-danger'>Agotado</span>";
                    } elseif ($p["stock"] <= 10) {
                        echo "<span class='text-warning'>Stock bajo</span>";
                    } else {
                        echo "<span class='text-success'>Disponible</span>";
                    }
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<a href="index.php" class="btn btn-secondary mt-3">Registrar otro producto</a>
<?php echo "</div></body></html>"; ?>
