<?php include 'estilo.php'; ?>
<h2>Registrar nuevo producto</h2>
<form method="post" action="inventario.php" class="border p-4 bg-white rounded mb-4">
    <div class="mb-3">
        <label class="form-label">Nombre del producto:</label>
        <input type="text" name="nombre" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Precio (S/):</label>
        <input type="number" name="precio" class="form-control" step="0.1" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Stock disponible:</label>
        <input type="number" name="stock" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Agregar al inventario</button>
</form>
<!-- 🔍 Botón para ver el inventario sin registrar -->
<a href="inventario.php" class="btn btn-outline-secondary">Ver Inventario</a>
<?php echo "</div></body></html>"; ?>
