<?php
$servername = "localhost";
$username = "Carlos";
$password = "123";
$dbname = "mi_tienda";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $nickname = $_POST['nickname'];
    $password = $_POST['password'];
    $telefono = $_POST['telefono'];
    $domicilio = $_POST['domicilio'];

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO cliente (nombre, apellido, nickname, password, telefono, domicilio) 
                VALUES (:nombre, :apellido, :nickname, :password, :telefono, :domicilio)";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':nickname', $nickname);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':domicilio', $domicilio);

        $stmt->execute();
        echo "Nuevo cliente creado exitosamente";
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $conn = null;
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