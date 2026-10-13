<?php 
include 'estilo.php'; 

// Inicialización y limpieza de variables de forma segura
$nombre = isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : '';
$fecha_nacimiento = isset($_POST['fecha_nacimiento']) ? $_POST['fecha_nacimiento'] : '';
$ingresos = isset($_POST['ingresos']) ? floatval($_POST['ingresos']) : 0;

function calcular($cumples) {
    if (empty($cumples)) return 0;
    $cumple = new DateTime($cumples);
    $today = new DateTime();
    $age = $today->diff($cumple)->y;
    return $age;
}

$edad = calcular($fecha_nacimiento);
?>

<h2 class="mb-4">Seleccionar tipo de crédito</h2>
<form method="post" action="resultado.php" class="border p-4 bg-white rounded shadow-sm">
  
  <!-- Propagación de datos anteriores -->
  <input type="hidden" name="nombre" value="<?php echo $nombre; ?>">
  <input type="hidden" name="fecha_nacimiento" value="<?php echo $fecha_nacimiento; ?>">
  <input type="hidden" name="ingresos" value="<?php echo $ingresos; ?>">
  <input type="hidden" name="edad" value="<?php echo $edad; ?>">

  <div class="mb-3">
    <p class="text-muted">Cliente: <strong><?php echo $nombre; ?></strong> (<?php echo $edad; ?> años)</p>
    <label class="form-label">Tipo de crédito solicitado:</label>
    <select name="tipo" class="form-select" required>
      <option value="">Seleccione una opción</option>
      <option value="Personal">Personal</option>
      <option value="Vehicular">Vehicular</option>
      <option value="Hipotecario">Hipotecario</option>
    </select>
  </div>
  <button type="submit" class="btn btn-success">Evaluar Crédito</button>
</form>

</div></body></html>
