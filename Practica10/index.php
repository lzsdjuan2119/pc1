<?php include 'estilo.php'; ?>
<h2>Registrar nuevo lote de exportación</h2>
<form method="post" action="registrar.php" class="border p-4 bg-white rounded mb-4">
    <div class="mb-3">
        <label class="form-label">Nombre del producto:</label>
        <select name="producto" class="form-select" required>
            <option value="">Seleccione un producto</option>
            <option value="Quinua">Quinua</option>
            <option value="Maíz morado">Maíz morado</option>
            <option value="Papa nativa">Papa nativa</option>
            <option value="Tarwi">Tarwi</option>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Cantidad exportada (en kilos):</label>
        <input type="number" name="cantidad" min="1" step="0.1" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Precio por kilo:</label>
        <input type="number" name="precio" min="0" step="0.1" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">País de destino:</label>
        <select name="pais" class="form-select" required>
            <option value="">Seleccione un país</option>
            <option value="EE.UU.">EE.UU.</option>
            <option value="Alemania">Alemania</option>
            <option value="España">España</option>
            <option value="Canadá">Canadá</option>
            <option value="Japón">Japón</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Guardar lote</button>
</form>
<a href="reporte.php" class="btn btn-outline-secondary">Ver Reporte</a>
<?php echo "</div></body></html>"; ?>
