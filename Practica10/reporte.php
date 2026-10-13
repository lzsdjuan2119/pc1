<?php include 'estilo.php'; ?>
<h2 class="mb-4">Reporte de Exportaciones</h2>
<?php
$lotes = [];
$archivo = 'exportaciones.txt';
if (file_exists($archivo)) {
    $lineas = file($archivo, FILE_IGNORE_NEW_LINES);
    foreach ($lineas as $linea) {
        list($producto, $cantidad, $precio, $pais) = explode(",", $linea);
        $lotes[] = [
            "producto" => $producto,
            "cantidad" => floatval($cantidad),
            "precio" => floatval($precio),
            "pais" => $pais
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
            <th>Precio por kilo</th>
            <th>Total</th>
            <th>País</th>
            <th>Alta Exportación</th>
            <th>Destino Especial</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($lotes as $l): 
            $total_lote = $l["cantidad"] * $l["precio"];
            $total_acumulado += $total_lote;

            if ($l["cantidad"] > 1000) {
                $alta = "Sí";
                $color_alta = "text-success";
                $alta_exportacion++;
            } else {
                $alta = "No";
                $color_alta = "text-muted";
            }

            if ($l["pais"] == "EE.UU." || $l["pais"] == "Alemania") {
                $especial = "Sí";
                $color_esp = "text-primary";
                $destinos_especiales++;
            } else {
                $especial = "No";
                $color_esp = "text-muted";
            }
        ?>
        <tr>
            <td><?php echo $l["producto"]; ?></td>
            <td><?php echo $l["cantidad"]; ?></td>
            <td>S/ <?php echo $l["precio"]; ?></td>
            <td>S/ <?php echo $total_lote; ?></td>
            <td><?php echo $l["pais"]; ?></td>
            <td class="<?php echo $color_alta; ?>"><?php echo $alta; ?></td>
            <td class="<?php echo $color_esp; ?>"><?php echo $especial; ?></td>
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
<div class="alert alert-warning">Aún no se han registrado lotes de exportación.</div>
<?php endif; ?>
<a href="index.php" class="btn btn-secondary">Registrar otro lote</a>
<?php echo "</div></body></html>"; ?>
