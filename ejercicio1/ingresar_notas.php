<?php
$cantidad = $_POST['cantidad'];
$nombre = $_POST['nombre'];
$asistencia = $_POST['asistencia'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Ingresar Notas</title>
</head>
<body>
    <h2>Ingresar <?php echo $cantidad; ?> notas para <?php echo htmlspecialchars($nombre); ?></h2>
    <form method="post" action="resultado.php">
        <?php
        for ($i = 1; $i <= $cantidad; $i++) {
            echo "Nota $i: <input type='number' name='notas[]' min='0' max='20' step='0.1' required><br>";
        }
        ?>
        <input type="hidden" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>">
        <input type="hidden" name="asistencia" value="<?php echo htmlspecialchars($asistencia); ?>">
        <br>
        <input type="submit" value="Evaluar">
    </form>
</body>
</html>
