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

<h2 style="text-align: center;">Productos de la tienda</h2>

<!-- Botón fuera de la tabla para añadir productos -->
<form action="../Vista/insertarProducto.php" method="post" style="text-align: center;">
    <button class="btn-add-product" type="submit" name="add_new_product">Añadir Producto</button>
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
                <form action="modificarProducto.php" method="get" style="display:inline;">
                    <button type="submit" name="id_modificar" value="<?php echo $producto->getId(); ?>">Modificar</button>
                </form>
                <form action="" method="get" style="display:inline;">
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