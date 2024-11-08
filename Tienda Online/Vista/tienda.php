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
    <div class="header">
        <div class="usuario">
            <?php
            require_once '../Modelo/Cliente.php';

            session_start();
            $datosSerializados = serialize($_SESSION['cliente']);
            $obj = unserialize($datosSerializados);
            echo "Bienvenido, " . htmlspecialchars($obj->getUsuario()) . "<br>";

            ?>
            <div class="menu">
                <a href="cerrar_sesion.php">Cerrar sesión</a>
            </div>
        </div>
    </div>
    <div class="botones">
        <div class="container">
            <button class="btn" onclick="window.location.href='select.php'">Listar Productos</button>
            <button class="btn" onclick="window.location.href='insert.php'">Insertar producto</button>
            <button class="btn" onclick="window.location.href='update.php'">Modificar Producto</button>
            <button class="btn" onclick="window.location.href='delete.php'">Eliminar Producto</button>
        </div>
    </div>
</body>
</html>