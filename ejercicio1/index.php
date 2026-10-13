<!DOCTYPE html>
<html>
<head>
    <title>Inicio - Evaluación del Estudiante</title>
</head>
<body>
    <h2>Evaluación del Estudiante</h2>
    <form method="post" action="ingresar_notas.php">
        <label>Nombre del estudiante:</label><br>
        <input type="text" name="nombre" required><br><br>
        <label>Porcentaje de asistencia:</label><br>
        <input type="number" name="asistencia" min="0" max="100" required><br><br>
        <label>¿Cuántas notas desea ingresar?:</label><br>
        <input type="number" name="cantidad" min="1" max="10" required><br><br>
        <input type="submit" value="Continuar">
    </form>
</body>
</html>
