<?php
session_start();
require_once '../Modelo/Cliente.php';
require_once '../Modelo/ClienteDAO.php';

$clienteDAO=new ClienteDAO();



try {
    $nickname=$_POST['user'];
    $contra=$_POST['pass'];
    if($clienteDAO->getClienteByNickname($nickname)){
        if($clienteDAO->getClienteByNicknameAndPassword($nickname, $contra)){
            // Crear una nueva instancia de la clase Usuario
            $nuevoCliente = new Cliente($nickname, $contra);

            // Guardar el objeto Usuario en la sesión
            $_SESSION['cliente'] = $nuevoCliente;

            header('location: ../Vista/tienda.php');
        }else{
            $error1= "Inicio de sesion incorrecto.";
            header("location:../Vista/login.php?error1=$error1");
            exit();
        }
    }else{
        $error2= "Usuario no existente.";
        header("location:../Vista/login.php?error2=$error2");
        exit();
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>