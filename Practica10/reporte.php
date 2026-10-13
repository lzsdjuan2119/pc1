<?php include 'estilo.php'; ?>
<h2 class="mb-4">Reporte de Exportaciones</h2>
<?php
$lotes = [];
$archivo = 'exportaciones.txt';

if (file_exists($archivo)) {
    $lineas = file($archivo, FILE_IGNORE_NEW_LINES);
    foreach ($lineas as $linea) {
        if (empty(trim($linea))) continue;
        list($producto, $cantidad, $precio, $pais) = explode(",", $linea);
        $total_lote = floatval($cantidad) * floatval($precio);
        $lotes[] = [
            "producto" => trim($producto),
            "cantidad" => floatval($cantidad),
            "precio"   => floatval($precio),
            "pais"     => trim($pais),
            "total"    => $total_lote
        ];
    }
}

$total_acumulado = 0;
$alta_exportacion = 0;
$destinos_especiales = 0;
?>
<table class="table table-bordered table-striped mt-3">
    <thead class="table-dark">
        <tr>
            <th>Producto</th>
            <th>Cantidad (kg)</th>
            <th>Precio/kg</th>
            <th>Total</th>
            <th>País</th>
            <th>Alta Exportación</th>
            <th>Destino Especial</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($lotes as $l): 
            $total_acumulado += $l["total"];

            // Lotes mayores a 1000 kg
            $es_alta = ($l["cantidad"] > 1000) ? "Sí" : "No";
            if ($l["cantidad"] > 1000) $alta_exportacion++;

            // Destinos especiales (EE.UU. o Alemania)
            $es_especial = ($l["pais"] == "EE.UU." || $l["pais"] == "Alemania") ? "Sí" : "No";
            if ($es_especial == "Sí") $destinos_especiales++;
        ?>
        <tr>
            <td><?php echo $l["producto"]; ?></td>
            <td><?php echo $l["cantidad"]; ?> kg</td>
            <td>S/ <?php echo $l["precio"]; ?></td>
            <td>S/ <?php echo $l["total"]; ?></td>
            <td><?php echo $l["pais"]; ?></td>
            <td class="<?php echo ($es_alta == 'Sí') ? 'text-success fw-bold' : ''; ?>"><?php echo $es_alta; ?></td>
            <td class="<?php echo ($es_especial == 'Sí') ? 'text-primary fw-bold' : ''; ?>"><?php echo $es_especial; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php if (count($lotes) > 0): ?>
<div class="alert alert-info">
    <p><strong>Valor total exportado acumulado:</strong> S/ <?php echo round($total_acumulado, 2); ?></p>
    <p><strong>Lotes mayores a 1000 kg (alta exportación):</strong> <?php echo $alta_exportacion; ?></p>
    <p><strong>Lotes a EE.UU. o Alemania (destinos especiales):</strong> <?php echo $destinos_especiales; ?></p>
</div>
<?php else: ?>
<div class="alert alert-warning">Aún no se han registrado lotes.</div>
<?php endif; ?>

<a href="index.php" class="btn btn-secondary">Registrar otro lote</a>
<?php echo "</div></body></html>"; ?>
