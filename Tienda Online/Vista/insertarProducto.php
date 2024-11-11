<?php
require_once '../Controlador/ControlProducto.php'; // Incluir el archivo del controlador
require_once '../Validaciones/ValidarProducto.php'; // Incluir la clase de validación
require_once '../Modelo/Producto.php';


$servername = "localhost";
$username = "Carlos";
$password = "123";
$dbname = "mi_tienda";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = trim($_POST['nombre']);
    $descripcion = trim($_POST['descripcion']);
    $precio = trim($_POST['precio']);
    $imagen = trim($_POST['imagen']);

    if (empty($errores)) {
        // Si no hay errores, crear una instancia del controlador
        $controlador = new ControlProducto();

        // Llamar al método para registrar al cliente
        $producto = new DTOProducto($nombre, $descripcion, $precio, $imagen);
        $controlador->crearProducto($producto);
    } else {
        // Si hay errores, mostrarlos
        foreach ($errores as $error) {
            echo "<p style='color: red;'>$error</p>";
        }
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
<form method="POST" action="">
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required><br><br>

    <label for="descripcion">Descripcion:</label>
    <input type="text" id="descripcion" name="descripcion" required><br><br>

    <label for="precio">Precio:</label>
    <input type="number" id="precio" name="precio" required><br><br>

    <label for="imagen">Imagen:</label>
    <input type="text" id="imagen" name="imagen" required><br><br>

    <button type="submit">Insertar Producto</button>
</form>
</body>
</html>