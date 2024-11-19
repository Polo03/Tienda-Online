<?php

session_start();
require_once '../Controlador/ControlCompras.php';
require_once '../Modelo/Cliente.php';
require_once '../Modelo/DTOCompra.php';
require_once '../Controlador/ControladorCliente.php';
require_once '../Modelo/ProductoDAO.php';
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
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de compras</title>
    <link rel="stylesheet" href="../CSS/historial_compras.css">
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

    <!-- Palabra con el menú que aparece al pasar el ratón -->
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

<h2 style="text-align: center;">Historial de compras</h2>
<?php
$controlCompras=new ControlCompras();
$controladorCliente= new ControladorCliente();
$productoDao=new ProductoDAO();
$id_cliente=$controladorCliente->getIdCliente($_SESSION['cliente']);
$compras=$controlCompras->getAllComprasByIdCliente($id_cliente);
if(count($compras)>0) {
// Bucle for para generar las secciones dinámicamente
    foreach ($compras as $i => $compra) {
        $nombreProducto = $productoDao->getProductoById($compra->getProductoId())->getNombre();
        $fecha = explode(" ", $compra->getFechaCompra());
        // Generamos un ID único para cada checkbox
        $checkbox_id = "toggle" . $i;
        $label_for = "toggle" . $i;
        echo "
    <section>
        <input type='checkbox' id='$checkbox_id'>
        <label for='$label_for'>Compra realizada a las " . $fecha[1] . " el día " . $fecha[0] . "</label>
        <div class='content'>
            <p> Ha comprado " . $compra->getCantidad() . " unidades del producto " . $nombreProducto . " </p>
        </div>
    </section>
    ";
    }
}
if(count($compras)==0): ?>
    <div class='mensaje'>¡Usted no ha realizado ninguna compra!</div>
<?php endif; ?>

</body>
</html>
