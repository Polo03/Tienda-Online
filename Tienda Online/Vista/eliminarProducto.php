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

    if (empty($errores)) {
        $productoDAO = new ProductoDAO();
        $producto = $productoDAO->getProductoByName($nombre);
        if ($producto != null) {
            $id = $producto->getId();
            // Si no hay errores, crear una instancia del controlador
            $controlador = new ControlProducto();

            // Llamar al método para eliminar el producto
            $controlador->eliminarProducto($producto);
        } else {
            echo "No existe ese nombre de producto";
        }
    }else {
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
    <title>Eliminar Producto</title>
    <link rel="stylesheet" href="../CSS/eliminarProducto.css">
</head>
<body>
<h2>Eliminar Producto</h2>
<form method="POST" action="">
    <label for="nombre">Nombre del producto:</label>
    <input type="text" id="nombre" name="nombre" required><br><br>

    <button type="submit">Eliminar Producto</button>
</form>
</body>
</html>