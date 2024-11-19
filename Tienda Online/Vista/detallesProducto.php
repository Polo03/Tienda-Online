<?php

require_once '../Controlador/ControlProducto.php';
$controlador= new ControlProducto();
//Obtener el ID del producto desde la URL (por ejemplo: modificar_producto.php?id=1)
if (isset($_GET['id'])) {
    $id_producto = $_GET['id'];
    $result=$controlador->getProducto($id_producto);
    // Guardar los datos en variables
    $producto = $result;
    $id = $producto->getId();
    $nombre = $producto->getNombre();
    $descripcion = $producto->getDescripcion();
    $precio = $producto->getPrecio();
    $imagen = $producto->getImagen();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Producto</title>
    <link rel="stylesheet" href="../CSS/modificarProducto.css">
</head>
<body>

<div class="popup-overlay">
    <div class="popup-content">
        <h1>Detalles del producto</h1>
        <form action="../Validaciones/validarDetalles.php" method="POST">
            <label for="id">ID:</label>
            <input type="text" id="id" name="id" value="<?php echo $id; ?>" readonly><br>

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>" readonly><br>

            <label for="precio">Precio:</label>
            <input type="text" id="precio" name="precio" value="<?php echo $precio; ?>" readonly><br>

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" rows="4" readonly><?php echo $descripcion; ?></textarea><br>

            <label for="imagen">Imagen:</label>
            <?php echo '<img src="' . htmlspecialchars($imagen) . '" alt="Imagen desde la base de datos">';?>
            <button class="close-btn" id="accion" name="salir">Salir</button>
        </form>


    </div>
</div>


</body>
</html>
