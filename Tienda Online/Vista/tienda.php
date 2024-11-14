<?php

session_start();

require_once '../Modelo/Cliente.php';
require_once '../Modelo/Producto.php';
require_once '../Modelo/DTOProducto.php';
// Aseguramos que $_SESSION['carrito'] esté inicializado, incluso si no hay productos en el carrito
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}
$numeroProductos=0;
if(!empty($_SESSION['carrito'])) {
    foreach($_SESSION['carrito'] as $productos){
        $numeroProductos=$numeroProductos+$productos[1];
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
            <img src="https://cdn-icons-png.flaticon.com/128/2601/2601726.png" width="30px">
            <div class="carrito-cantidad">
                <span id="carrito-cantidad"><?php echo $numeroProductos; ?></span>
            </div>

        </a>
    </div>


    <div class="menu-container">
        <span class="palabra">
            <?php

            $datosSerializados = serialize($_SESSION['cliente']);
            $obj = unserialize($datosSerializados);
            echo "Bienvenido, " . htmlspecialchars($obj->getUsuario());
            ?>
        </span>
        <div class="menu">
            <ul>
                <li><a href="historial_compras.php">Historial de compras</a></li>
                <li><a href="cerrar_sesion.php">Cerrar Sesión</a></li>
            </ul>
        </div>
    </div>
</div>

<h2 style="text-align: center;">Productos de la tienda</h2>

<!-- Botón fuera de la tabla para añadir productos -->
<form action="../Vista/insertarProducto.php" method="post" style="text-align: center;">
    <button class="btn-add-product" type="submit" name="añadeProducto">Añadir Producto</button>
</form>

<table>
    <thead>
    <tr>
        <th></th>
        <th>Producto</th>
        <th>Precio</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    <?php
    require_once '../Controlador/ControlProducto.php';
    $controlador=new ControlProducto();
    $productos=$controlador->getAllProductos();
    foreach ($productos as $producto):?>
        <tr>
            <td><?php echo "<img src=".$producto->getImagen().">"?></td>
            <td><?php echo $producto->getNombre(); ?></td>
            <td><?php echo "$" . $producto->getPrecio(); ?></td>
            <td>
                <form action="detallesProducto.php" method="get" style="display:inline;">
                    <button type="submit" name="id_detalles" value="<?php echo $producto->getId(); ?>">Detalles</button>
                </form>
                <form action="modificarProducto.php" method="get" style="display:inline;">
                    <button type="submit" name="id_modificar" value="<?php echo $producto->getId(); ?>">Modificar</button>
                </form>
                <form action="../Validaciones/anyadirCarrito.php" method="get" style="display:inline;">
                    <button type="submit" name="id_carrito" value="<?php echo $producto->getId(); ?>">Añadir al carrito</button>
                </form>
                <form action="eliminarProducto.php" method="get" style="display:inline;">
                    <button type="submit" name="id_eliminar" value="<?php echo $producto->getId(); ?>">Eliminar</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>