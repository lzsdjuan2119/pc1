<?php include 'estilo.php'; ?>
<div class="card shadow-sm border-0 mb-4">
    <div class="card-body p-4 bg-white rounded">
        <h2 class="text-primary mb-1">AndesPerú Export S.A.C.</h2>
        <p class="text-muted mb-4">Sistema de Registro y Evaluación de Exportación Agrícola</p>

        <form method="post" action="registrar.php" class="border p-4 bg-light rounded mb-4">
            <h4 class="mb-3 text-secondary">Registrar Nuevo Lote Exportado</h4>

            <div class="mb-3">
                <label class="form-label fw-semibold">Nombre del producto:</label>
                <select name="producto" class="form-select" required>
                    <option value="">-- Seleccione un producto --</option>
                    <option value="Quinua">Quinua</option>
                    <option value="Maíz morado">Maíz morado</option>
                    <option value="Papa nativa">Papa nativa</option>
                    <option value="Tarwi">Tarwi</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Cantidad exportada (en kilos):</label>
                <input type="number" name="cantidad" step="0.01" min="0.01" class="form-control" placeholder="Ej. 1200" required>
                <div class="form-text text-muted">Lotes mayores a 1000 kg se consideran de "alta exportación".</div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Precio por kilo ($):</label>
                <input type="number" name="precio" step="0.01" min="0.01" class="form-control" placeholder="Ej. 5.50" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">País de destino:</label>
                <select name="pais" class="form-select" required>
                    <option value="">-- Seleccione el país de destino --</option>
                    <option value="EE.UU.">EE.UU. (Destino especial)</option>
                    <option value="Alemania">Alemania (Destino especial)</option>
                    <option value="España">España</option>
                    <option value="Canadá">Canadá</option>
                    <option value="Japón">Japón</option>
                    <option value="Francia">Francia</option>
                    <option value="Italia">Italia</option>
                    <option value="Reino Unido">Reino Unido</option>
                    <option value="Países Bajos">Países Bajos</option>
                    <option value="Chile">Chile</option>
                </select>
                <div class="form-text text-muted">EE.UU. y Alemania están catalogados como destinos especiales.</div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Guardar Lote</button>
                <a href="reporte.php" class="btn btn-outline-secondary">Ver Reporte Acumulado</a>
                <a href="../index.php" class="btn btn-outline-dark">Volver al Menú Principal</a>
            </div>
        </form>
    </div>
</div>
<?php echo "</div></body></html>"; ?>
