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

} else {
    echo "ID de producto no especificado";
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página con Formulario en Pop-up</title>
    <link rel="stylesheet" href="../CSS/modificarProducto.css">
</head>
<body>

<!-- Contenedor principal que actúa como el pop-up -->
<div class="popup-overlay">
    <div class="popup-content">
        <h1>Modificar Producto</h1>

        <!-- Formulario -->
        <form action="../Validaciones/validarUpdate.php" method="POST">
            <!-- Campo ID (solo lectura) -->
            <label for="id">ID:</label>
            <input type="text" id="id" name="id" value="<?php echo $id; ?>" readonly><br>

            <!-- Campo Nombre -->
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required><br>

            <!-- Campo Precio -->
            <label for="precio">Precio:</label>
            <input type="text" id="precio" name="precio" value="<?php echo $precio.'€'; ?>" required><br>

            <!-- Campo Descripción -->
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" rows="4" required><?php echo $descripcion; ?></textarea><br>

            <!-- Campo Precio -->
            <label for="imagen">Imagen (URL):</label>
            <input type="text" id="imagen" name="imagen" value="<?php echo $imagen;?>" required><br>

            <button class="close-btn" type="sumbit">Modificar</button>
        </form>


    </div>
</div>


</body>
</html>