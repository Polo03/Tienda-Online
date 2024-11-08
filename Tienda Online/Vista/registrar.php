<?php
require_once '../Controlador/ControlCliente.php'; // Incluir el archivo del controlador
require_once '../Validaciones/ValidarRegistrar.php'; // Incluir la clase de validación
require_once '../Modelo/Cliente.php';


$servername = "localhost";
$username = "Carlos";
$password = "123";
$dbname = "mi_tienda";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $nickname = trim($_POST['nickname']);
    $password = trim($_POST['password']);
    $telefono = trim($_POST['telefono']);
    $domicilio = trim($_POST['domicilio']);

    if (empty($errores)) {
        // Si no hay errores, crear una instancia del controlador
        $controlador = new ControlCliente();

        // Llamar al método para registrar al cliente
        $cliente = new DTOCliente($nombre, $apellido, $nickname, $password, $telefono, $domicilio);
        $controlador->crearCliente($cliente);

        // Mostrar mensaje de éxito
        echo "<p>Nuevo cliente creado exitosamente</p>";
    } else {
        // Si hay errores, mostrarlos
        foreach ($errores as $error) {
            echo "<p style='color: red;'>$error</p>";
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