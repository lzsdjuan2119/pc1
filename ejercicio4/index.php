<?php include 'estilo.php'; ?>
<h2>Simulador de compra</h2>
<form method="post" action="cliente.php" class="border p-4 bg-white rounded">
  <div class="mb-3">
    <label class="form-label">Producto:</label>
    <select name="producto" class="form-select" required>
      <option value="">Seleccione</option>
      <option value="Laptop">Laptop - S/ 2500</option>
      <option value="Smartphone">Smartphone - S/ 1500</option>
      <option value="Audifonos">Audífonos - S/ 200</option>
    </select>
  </div>
  <div class="mb-3">
    <label class="form-label">Cantidad:</label>
    <input type="number" name="cantidad" min="1" class="form-control" required>
  </div>
  <button type="submit" class="btn btn-primary">Continuar</button>
</form>
<?php echo "</div></body></html>"; ?>
