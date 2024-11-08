<?php
require_once '../Controlador/ControladorCliente.php'; // Incluir el archivo del controlador

$servername = "localhost";
$username = "Carlos";
$password = "123";
$dbname = "mi_tienda";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $nickname = $_POST['nickname'];
    $password = $_POST['password'];
    $telefono = $_POST['telefono'];
    $domicilio = $_POST['domicilio'];

    // Crear una instancia del controlador
    $controlador = new ControladorCliente();

    // Llamar al método para registrar al cliente
    $errores = $controlador->registrarCliente($nombre, $apellido, $nickname, $password, $telefono, $domicilio);

    if (empty($errores)) {
        // Si no hay errores, mostrar mensaje de éxito
        echo "Nuevo cliente creado exitosamente";
    } else {
        // Si hay errores, mostrarlos
        foreach ($errores as $error) {
            echo "<p>$error</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Cliente</title>
    <link rel="stylesheet" href="../CSS/registrar.css">
</head>
<body>
<h2>Registrarse</h2>
<form method="POST" action="">
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required><br><br>

    <label for="apellido">Apellido:</label>
    <input type="text" id="apellido" name="apellido" required><br><br>

    <label for="nickname">Nickname:</label>
    <input type="text" id="nickname" name="nickname" required><br><br>

    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password" required><br><br>

    <label for="telefono">Teléfono:</label>
    <input type="text" id="telefono" name="telefono" required><br><br>

    <label for="domicilio">Domicilio:</label>
    <input type="text" id="domicilio" name="domicilio" required><br><br>

    <button type="submit">Insertar Cliente</button>
</form>
</body>
</html>