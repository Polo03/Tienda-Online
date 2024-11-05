<?php
require_once '../Cliente.php';


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mi_tienda";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sqlUser = "SELECT * FROM cliente where nickname = '$_POST[user]'";
$resultUser = $conn->query($sqlUser);

if ($resultUser->num_rows > 0) {
    $sql = "SELECT * FROM cliente where nickname = '$_POST[user]' and password = '$_POST[pass]'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // Crear una nueva instancia de la clase Usuario
        $nuevoCliente = new Cliente($_POST['user'], $_POST['pass']);

        // Guardar el objeto Usuario en la sesión
        $_SESSION['cliente'] = $nuevoCliente;

        header('location:../tienda.php');
    } else {
        $error1= "Inicio de sesion incorrecto.";
        header("location:../login.php?error1=' . $error1");
        exit();
    }
} else {
    $error2= "Usuario no existente.";
    header("location:../login.php?error2=' . $error2");
    exit();
}
$conn->close();
?>