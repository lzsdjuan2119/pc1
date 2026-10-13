<!DOCTYPE html>
<html>
<head>
    <title>Registro de Vacunación</title>
</head>
<body>
    <h2>Formulario de Vacunación</h2>
    <form method="post" action="resultado.php">
        <label>Nombre del paciente:</label><br>
        <input type="text" name="nombre" required><br><br>
        <label>Edad del paciente:</label><br>
        <input type="number" name="edad" min="0" required><br><br>
        <label>Vacuna a aplicar:</label><br>
        <select name="vacuna" required>
            <option value="">Seleccione</option>
            <option value="Influenza">Influenza</option>
            <option value="Sarampion">Sarampión</option>
            <option value="COVID-19">COVID-19</option>
            <option value="Hepatitis B">Hepatitis B</option>
        </select><br><br>
        <input type="submit" value="Evaluar">
    </form>
</body>
</html>
