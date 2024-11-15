<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Producto</title>
    <link rel="stylesheet" href="../CSS/insertarProducto.css">
</head>
<body>

<!-- Contenedor principal que actúa como el pop-up -->
<div class="popup-overlay">
    <div class="popup-content">
        <h1>Insertar Producto</h1>
        <?php
        // Mostrar avisos si existen en la URL
        if (isset($_GET['error']))
            echo "<p style='color: red;'>$_GET[error]</p>";
        ?>
        <!-- Formulario -->
        <form action="../Validaciones/validarInsertar.php" method="POST">
            <!-- Campo Nombre -->
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" pattern="{1,}"><br><br>

            <!-- Campo Precio -->
            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" pattern="^\d+,\d{2}$"><br><br>

            <!-- Campo Descripción -->
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" rows="4"></textarea><br>

            <!-- Campo Precio -->
            <label for="imagen">Imagen (URL):</label>
            <input type="text" id="imagen" name="imagen" pattern="{1,}"><br><br>

            <button class="accept-btn" name="accion" type="submit" value="insertar">Insertar Producto</button>
            <button class="close-btn" name="accion" value="cerrar">Salir</button>
        </form>
    </div>
</div>
</body>
</html>