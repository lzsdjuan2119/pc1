<?php include 'estilo.php'; ?>
<h2 class="mb-4">Seleccionar tipo de crédito</h2>
<form method="post" action="resultado.php" class="border p-4 bg-white rounded">
  <?php
  $nombre = $_POST['nombre'];
  $edad = $_POST['edad'];
  $ingresos = $_POST['ingresos'];
  ?>
  <input type="hidden" name="nombre" value="<?php echo $nombre; ?>">
  <input type="hidden" name="edad" value="<?php echo $edad; ?>">
  <input type="hidden" name="ingresos" value="<?php echo $ingresos; ?>">
  <div class="mb-3">
    <label class="form-label">Tipo de crédito:</label>
    <select name="tipo" class="form-select" required>
      <option value="">Seleccione</option>
      <option value="Personal">Personal</option>
      <option value="Vehicular">Vehicular</option>
      <option value="Hipotecario">Hipotecario</option>
    </select>
  </div>
  <button type="submit" class="btn btn-success">Evaluar Crédito</button>
</form>
<?php echo "</div></body></html>"; ?>
