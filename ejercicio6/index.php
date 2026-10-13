<?php include 'estilo.php'; ?>
<h2>Registrar nuevo estudiante</h2>
<form method="post" action="registrar.php" class="border p-4 bg-white rounded mb-4">
    <div class="mb-3">
        <label class="form-label">Nombre completo:</label>
        <input type="text" name="nombre" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Nota final:</label>
        <input type="number" name="nota" min="0" max="20" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Guardar</button>
</form>
<a href="reporte.php" class="btn btn-outline-secondary">Ver Reporte Académico</a>
<?php echo "</div></body></html>"; ?>
