<?php include 'estilo.php'; ?>
<h2 class="mb-4">Reporte Académico</h2>
<?php
$estudiantes = [];
$archivo = 'estudiantes.txt';
if (file_exists($archivo)) {
    $lineas = file($archivo, FILE_IGNORE_NEW_LINES);
    foreach ($lineas as $linea) {
        list($nombre, $nota) = explode(",", $linea);
        $estudiantes[] = [
            "nombre" => $nombre,
            "nota" => floatval($nota)
        ];
    }
}
$total = 0;
$aprobados = 0;
$desaprobados = 0;
?>
<table class="table table-bordered table-striped mt-3">
    <thead class="table-dark">
        <tr>
            <th>Estudiante</th>
            <th>Nota</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($estudiantes as $e): 
            $estado = ($e["nota"] >= 13) ? "Aprobado" : "Desaprobado";
            $color = ($estado === "Aprobado") ? "text-success" : "text-danger";
            $total += $e["nota"];
            if ($estado === "Aprobado") $aprobados++; else $desaprobados++;
        ?>
        <tr>
            <td><?php echo $e["nombre"]; ?></td>
            <td><?php echo $e["nota"]; ?></td>
            <td class="<?php echo $color; ?>"><?php echo $estado; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php if (count($estudiantes) > 0): 
    $promedio = $total / count($estudiantes);
?>
<div class="alert alert-info">
    <p><strong>Promedio general:</strong> <?php echo round($promedio, 2); ?></p>
    <p><strong>Total de aprobados:</strong> <?php echo $aprobados; ?></p>
    <p><strong>Total de desaprobados:</strong> <?php echo $desaprobados; ?></p>
</div>
<?php else: ?>
<div class="alert alert-warning">Aún no se han registrado estudiantes.</div>
<?php endif; ?>
<a href="index.php" class="btn btn-secondary">Registrar otro estudiante</a>
<?php echo "</div></body></html>"; ?>
