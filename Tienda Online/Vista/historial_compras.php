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
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sección Desplegable sin JS</title>
    <link rel="stylesheet" href="../CSS/historial_compras.css">
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
                <li><a href="historial_compras.php">Historial de compras</a></li>
                <li><a href="cerrar_sesion.php">Cerrar Sesión</a></li>
            </ul>
        </div>
    </div>
</div>

<h2 style="text-align: center;">Historial de compras</h2>
<?php
$control=new ControlCompras();
$compras=$control->getAllCompras();
// Número de secciones que quieres generar
$secciones = 3;
print_r($compras);
/*// Bucle for para generar las secciones dinámicamente
for ($i = 1; $i <= $secciones; $i++) {
    // Generamos un ID único para cada checkbox
    $checkbox_id = "toggle" . $i;
    $label_for = "toggle" . $i;
    echo "
    <section>
        <input type='checkbox' id='$checkbox_id'>
        <label for='$label_for'>Haz clic para ver más información de la Sección $i</label>
        <div class='content'>
            <p>Este es el contenido adicional de la Sección $i. Aquí puedes agregar más detalles o información relevante.</p>
        </div>
    </section>
    ";
}*/
?>

</body>
</html>
