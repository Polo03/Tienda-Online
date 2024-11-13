<?php

session_start();
require_once '../Controlador/ControlProducto.php';
require_once '../Modelo/Cliente.php';
// Aseguramos que $_SESSION['carrito'] esté inicializado, incluso si no hay productos en el carrito
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Obtener el número de productos en el carrito
$numeroProductos = count($_SESSION['carrito']);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="../CSS/carrito.css">
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

    <!-- Palabra con el menú que aparece al pasar el ratón -->
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
                <li><a href="#">Historial de compras</a></li>
                <li><a href="cerrar_sesion.php">Cerrar Sesión</a></li>
            </ul>
        </div>
    </div>
</div>

<h2 style="text-align: center;">Carrito</h2>

<table>
    <thead>
    <tr>
        <th></th>
        <th>Producto</th>
        <th>Precio</th>
        <th>Unidades</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $control=new ControlProducto();
    foreach ($_SESSION['carrito'] as $productos):
        $producto=$control->getProducto($productos[0]);
        ?>
        <tr>
            <td><?php echo "<img src=".$producto->getImagen().">"?></td>
            <td><?php echo $producto->getNombre(); ?></td>
            <td><?php echo "$" . $producto->getPrecio(); ?></td>
            <td><?php echo $productos[1]; ?></td>
            <td>
                <form action="../Validaciones/eliminarCarrito.php" method="get" style="display:inline;">
                    <button type="submit" name="id" value="<?php echo $producto->getId(); ?>">Eliminar 1 unidad</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<form action="../Validaciones/confirmarCompra.php" method="POST">
    <div class="botones">
        <button type="submit" class="accept-btn">Comprar</button>
        <button class="close-btn" onclick="window.location.href='tienda.php">Volver</button>
    </div>
</form>

</body>
</html>