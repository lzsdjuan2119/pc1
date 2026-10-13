<?php include 'estilo.php'; ?>
<h2>Resumen de Compra</h2>
<?php
$producto = $_POST['producto'];
$cantidad = $_POST['cantidad'];
$cliente = $_POST['cliente'];
$precios = [
    "Laptop" => 2500,
    "Smartphone" => 1500,
    "Audifonos" => 200
];
$precio_unitario = $precios[$producto];
$subtotal = $precio_unitario * $cantidad;
$descuento = 0;
if ($cliente === "Estudiante") {
    $descuento = 0.10 * $subtotal;
}
$total = $subtotal - $descuento;
echo "<p><strong>Producto:</strong> $producto</p>";
echo "<p><strong>Cantidad:</strong> $cantidad</p>";
echo "<p><strong>Precio unitario:</strong> S/ $precio_unitario</p>";
echo "<p><strong>Subtotal:</strong> S/ $subtotal</p>";
echo "<p><strong>Descuento aplicado:</strong> S/ $descuento</p>";
echo "<p class='fw-bold fs-5'>Total a pagar: <span class='text-success'>S/ $total</span></p>";
?>
<?php echo "</div></body></html>"; ?>
