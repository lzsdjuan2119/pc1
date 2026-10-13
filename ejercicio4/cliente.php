<?php include 'estilo.php'; ?>
<h2>Tipo de Cliente</h2>
<?php
$producto = $_POST['producto'];
$cantidad = $_POST['cantidad'];
?>
<form method="post" action="total.php" class="border p-4 bg-white rounded">
  <input type="hidden" name="producto" value="<?php echo $producto; ?>">
  <input type="hidden" name="cantidad" value="<?php echo $cantidad; ?>">
  <div class="mb-3">
    <label class="form-label">Tipo de cliente:</label>
    <select name="cliente" class="form-select" required>
      <option value="">Seleccione</option>
      <option value="General">General</option>
      <option value="Estudiante">Estudiante (10% descuento)</option>
    </select>
  </div>
  <button type="submit" class="btn btn-success">Calcular total</button>
</form>
<?php echo "</div></body></html>"; ?>
