<?php
$user = $_POST['user'];
$pass = $_POST['pass'];
$error = '';

if (($user!="admin" && $user!='cliente') || ($pass!='admin' && $pass!='cliente'))
    $error= "Inicio de sesion incorrecto";

if ($error!="Inicio de sesion incorrecto") {
    $_SESSION['user']=$user;
    $_SESSION['pass']=$pass;
    header('location:../Vistas/tienda.php');
} else if($error == "Inicio de sesion incorrecto") {
//  Redirigir a index.php con mensajes de error
    header('Location: ../Vistas/login.php?error=' . $error);
    exit();
}
?>