<?php include 'estilo.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="text-primary mb-1">AndesPerú Export S.A.C.</h2>
        <h4 class="text-secondary mb-0">Reporte Acumulado de Lotes de Exportación</h4>
    </div>
    <a href="index.php" class="btn btn-primary">Registrar Nuevo Lote</a>
</div>

<?php
$lotes = [];
$archivo = 'exportaciones.txt';

// Lectura de los registros utilizando file()
if (file_exists($archivo)) {
    $lineas = file($archivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lineas as $linea) {
        $linea = trim($linea);
        if ($linea === "") {
            continue;
        }

        $datos = explode(",", $linea);
        if (count($datos) >= 4) {
            $producto = trim($datos[0]);
            $cantidad = floatval($datos[1]);
            $precio   = floatval($datos[2]);
            $pais     = trim($datos[3]);

            // Cálculo automático del valor total por lote (cantidad × precio)
            $total_lote = $cantidad * $precio;

            // Almacenamiento en Array Asociativo
            $lotes[] = [
                "producto" => $producto,
                "cantidad" => $cantidad,
                "precio"   => $precio,
                "pais"     => $pais,
                "total"    => $total_lote
            ];
        }
    }
}

// Variables acumuladoras y contadores
$total_acumulado = 0;
$alta_exportacion = 0;
$destinos_especiales = 0;
?>

<div class="card shadow-sm border-0 mb-4">
    <div class="card-body p-4 bg-white rounded">
        <h5 class="card-title text-secondary mb-3">Lista Detallada de Lotes Registrados</h5>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center">N° Lote</th>
                        <th>Producto</th>
                        <th class="text-end">Cantidad (kg)</th>
                        <th class="text-end">Precio / kg ($)</th>
                        <th class="text-end">Valor Total ($)</th>
                        <th>País de Destino</th>
                        <th class="text-center">Clasificación de Exportación</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($lotes) > 0): ?>
                        <?php foreach ($lotes as $indice => $lote): 
                            // Cálculo de acumuladores
                            $total_acumulado += $lote["total"];

                            // Condicional para lotes mayores a 1000 kg (alta exportación)
                            $es_alta_exportacion = ($lote["cantidad"] > 1000);
                            if ($es_alta_exportacion) {
                                $alta_exportacion++;
                            }

                            // Condicional para destinos especiales (EE.UU. o Alemania)
                            $pais_norm = trim(mb_strtoupper($lote["pais"], "UTF-8"));
                            $es_destino_especial = in_array($pais_norm, ["EE.UU.", "EEUU", "ESTADOS UNIDOS", "ALEMANIA"]);
                            if ($es_destino_especial) {
                                $destinos_especiales++;
                            }
                        ?>
                        <tr>
                            <td class="text-center fw-bold"><?php echo ($indice + 1); ?></td>
                            <td><?php echo htmlspecialchars($lote["producto"]); ?></td>
                            <td class="text-end"><?php echo number_format($lote["cantidad"], 2); ?> kg</td>
                            <td class="text-end">$ <?php echo number_format($lote["precio"], 2); ?></td>
                            <td class="text-end fw-semibold">$ <?php echo number_format($lote["total"], 2); ?></td>
                            <td>
                                <?php echo htmlspecialchars($lote["pais"]); ?>
                                <?php if ($es_destino_especial): ?>
                                    <span class="badge bg-primary ms-1">Destino especial</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if ($es_alta_exportacion): ?>
                                    <span class="badge bg-success">Alta exportación (&gt; 1000 kg)</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Estándar (&le; 1000 kg)</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted py-3">No hay lotes de exportación registrados actualmente.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php if (count($lotes) > 0): ?>
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-primary text-white h-100">
                <div class="card-body">
                    <h6 class="card-title text-white-50">Valor Total Acumulado</h6>
                    <h3 class="fw-bold mb-1">$ <?php echo number_format($total_acumulado, 2); ?></h3>
                    <small>Monto total de exportaciones</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-success text-white h-100">
                <div class="card-body">
                    <h6 class="card-title text-white-50">Lotes de Alta Exportación</h6>
                    <h3 class="fw-bold mb-1"><?php echo $alta_exportacion; ?> lote(s)</h3>
                    <small>Lotes con cantidad &gt; 1000 kg</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-info text-white h-100">
                <div class="card-body">
                    <h6 class="card-title text-white-50">Destinos Especiales</h6>
                    <h3 class="fw-bold mb-1"><?php echo $destinos_especiales; ?> lote(s)</h3>
                    <small>Exportaciones a EE.UU. o Alemania</small>
                </div>
            </div>
        </div>
    </div>

    <div class="alert alert-info shadow-sm mb-4">
        <h5 class="alert-heading mb-2">Resumen General</h5>
        <hr>
        <p class="mb-1"><strong>Total de lotes registrados:</strong> <?php echo count($lotes); ?></p>
        <p class="mb-1"><strong>Valor total exportado acumulado:</strong> $ <?php echo number_format($total_acumulado, 2); ?></p>
        <p class="mb-1"><strong>Lotes de alta exportación (&gt; 1000 kg):</strong> <?php echo $alta_exportacion; ?></p>
        <p class="mb-0"><strong>Lotes con destino especial (EE.UU. o Alemania):</strong> <?php echo $destinos_especiales; ?></p>
    </div>
<?php else: ?>
    <div class="alert alert-warning shadow-sm mb-4">Aún no se han registrado lotes en el sistema.</div>
<?php endif; ?>

<div class="d-flex gap-2">
    <a href="index.php" class="btn btn-secondary">Registrar otro lote</a>
    <a href="../index.php" class="btn btn-outline-dark">Volver al Menú Principal</a>
</div>

<?php echo "</div></body></html>"; ?>
