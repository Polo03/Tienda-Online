<?php
require_once '../Cliente.php';


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mi_tienda";

try {
    $nickname=$_POST['user'];
    $contra=$_POST['pass'];
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmtUser = $conn->prepare("SELECT * FROM cliente where nickname = '$nickname'");
    $stmtUser->execute();

    // set the resulting array to associative
    $result = $stmtUser->setFetchMode(PDO::FETCH_ASSOC);
    if($stmtUser->rowCount()>0) {
        $stmt = $conn->prepare("SELECT * FROM cliente where nickname = '$nickname' and password = '$contra'");
        $stmt->execute();

        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        if($stmt->rowCount()>0) {
            // Crear una nueva instancia de la clase Usuario
            $nuevoCliente = new Cliente($_POST['user'], $_POST['pass']);

            // Guardar el objeto Usuario en la sesión
            $_SESSION['cliente'] = $nuevoCliente;

            header('location:../tienda.php');
        }else{
            $error1= "Inicio de sesion incorrecto.";
            header("location:../login.php?error1=$error1");
            exit();
        }
    }else{
        $error2= "Usuario no existente.";
        header("location:../login.php?error2=$error2");
        exit();
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>