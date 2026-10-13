<?php include 'estilo.php'; ?>

<h2 class="mb-4">Simulador de Crédito - Datos del Cliente</h2>
<form method="post" action="evaluar.php" class="border p-4 bg-white rounded shadow-sm">
  <div class="mb-3">
    <label class="form-label">Nombre completo:</label>
    <input type="text" name="nombre" class="form-control" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Fecha de nacimiento:</label>
    <input type="date" name="fecha_nacimiento" class="form-control" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Ingresos mensuales (S/):</label>
    <input type="number" name="ingresos" class="form-control" min="0" step="0.01" required>
  </div>
  <button type="submit" class="btn btn-primary">Siguiente</button>
</form>

</div></body></html>
