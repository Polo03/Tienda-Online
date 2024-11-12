<?php

if (isset($_GET['error'])) {
    $error = explode(",", $_GET['error']);
    foreach ($error as $msg) {
        echo "<p style='color: red;'>$msg</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Cliente</title>
    <link rel="stylesheet" href="../CSS/registrar.css">
</head>
<body>
<h2>Registrarse</h2>
<form method="POST" action="../Validaciones/validarRegistrar.php">
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" pattern="^[a-zA-Z]+$" required><br><br>

    <label for="apellido">Apellido:</label>
    <input type="text" id="apellido" name="apellido" pattern="^[a-zA-Z]+$" required><br><br>

    <label for="nickname">Nickname:</label>
    <input type="text" id="nickname" name="nickname" pattern="^[a-zA-Z0-9]+$" required><br><br>

    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{5,}" required><br><br>

    <label for="telefono">Teléfono:</label>
    <input type="text" id="telefono" name="telefono" pattern="^\d{9}$" required><br><br>

    <label for="domicilio">Domicilio:</label>
    <input type="text" id="domicilio" name="domicilio" pattern="{1,}" required><br><br>

    <button type="submit">Registrar Cliente</button>
</form>
</body>
</html>