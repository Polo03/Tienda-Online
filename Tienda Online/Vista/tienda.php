<?php

session_start();

require_once '../Controlador/ControladorCliente.php';
require_once '../Controlador/ControlProducto.php';
require_once '../Modelo/DTOProducto.php';
// Aseguramos que $_SESSION['carrito'] esté inicializado, incluso si no hay productos en el carrito
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}
$numeroProductos=0;
if(!empty($_SESSION['carrito'])) {
    foreach ($_SESSION['carrito'] as $productos) {
        $numeroProductos = $numeroProductos + $productos[1];
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tienda Online</title>
    <link rel="stylesheet" href="../CSS/tienda.css">
</head>
<body>
<!-- Barra superior -->
<div class="barra-superior">

    <div class="contenedor-carrito">
        <a href="carrito.php" class="carrito-link">
            <p>🛒</p>
            <div class="carrito-cantidad">
                <span id="carrito-cantidad"><?php echo $numeroProductos; ?></span>
            </div>

        </a>
    </div>


    <div class="menu-container">
        <span class="palabra">
            <?php
            $controlador=new ControladorCliente();
            echo "Bienvenido, " . $controlador->getNombreClienteByNickname($_SESSION['cliente']);
            ?>
        </span>
        <div class="menu">
            <ul>
                <li><a href="tienda.php">Inicio</a></li>
                <li><a href="historial_compras.php">Historial de compras</a></li>
                <li><a href="cerrar_sesion.php">Cerrar Sesión</a></li>
            </ul>
        </div>
    </div>
</div>

<h2 style="text-align: center;">Productos de la tienda</h2>

<!-- Botón fuera de la tabla para añadir productos -->
<form action="../Vista/insertarProducto.php" method="post">
    <button class="btn-add-product" type="submit" name="añadeProducto">Añadir Producto</button>
</form>

<?php

// Generar la tabla HTML
echo '<div class="table-container">';
echo '<table>';
echo '<tbody>';

$productCount = 0; // Contador para crear nuevas filas cada 5 productos
$controlador = new ControlProducto();
$productos = $controlador->getAllProductos();
// Recorrer el array de productos
foreach ($productos as $producto) {
if ($productCount % 5 == 0) {
// Cada 5 productos, creamos una nueva fila
if ($productCount > 0) {
echo '</tr>';  // Cerrar la fila anterior
}
echo '<tr>';  // Iniciar una nueva fila
}

// Imprimir cada celda de la tabla con los datos del producto
echo '<td>';
echo '<div class="product-container">';
echo '<div class="product-name">' . htmlspecialchars($producto->getNombre()) . '</div>';
echo '<div class="product-price">' . number_format($producto->getPrecio(), 2) . '€</div>';
echo '<img src="' . $producto->getImagen() . '" alt="' . htmlspecialchars($producto->getNombre()) . '">';
echo '<form action="../Validaciones/validarBotonesTienda.php" method="GET">';
echo '<div class="buttons-container">';

echo '<button  class="button" type="submit" name="id_detalles" value='.$producto->getId().'>👁️<span class="tooltip">Detalles del producto</span></button>';
echo '<button class="button" type="submit" name="id_modificar" value='.$producto->getId().'>🔧️<span class="tooltip">Modificar producto</span></button>';
echo '<button class="button" type="submit" name="id_carrito" value='.$producto->getId().'>➕<span class="tooltip">Añadir al carrito</span></button>';
echo '<button class="button" type="submit" name="id_eliminar" value='.$producto->getId().'>➖<span class="tooltip">Eliminar Producto</span></button>';
echo '</div>';
echo '</form>';
echo '</div>';
echo '</td>';

$productCount++;
}

// Cerrar la última fila si es necesario
if ($productCount % 5 != 0) {
echo '</tr>';
}

echo '</tbody>';
echo '</table>';
echo '</div>';

?>

<footer>
    <div class="nombres">Adrian Polo & Carlos Villegas</div>
</footer>
</body>
</html>