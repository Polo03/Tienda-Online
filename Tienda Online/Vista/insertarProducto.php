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
    <title>Insertar Producto</title>
    <link rel="stylesheet" href="../CSS/insertarProducto.css">
</head>
<body>
<h2>Insertar Producto</h2>
<form method="POST" action="../Validaciones/validarInsertar.php">
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" pattern="{1,}" required><br><br>

    <label for="descripcion">Descripcion:</label>
    <input type="text" id="descripcion" name="descripcion" pattern="{1,}" required><br><br>

    <label for="precio">Precio:</label>
    <input type="number" id="precio" name="precio" pattern="^\d+,\d{2}$" required><br><br>

    <label for="imagen">Imagen:</label>
    <input type="text" id="imagen" name="imagen" pattern="{1,}" required><br><br>

    <button type="submit">Insertar Producto</button>
</form>
</body>
</html>