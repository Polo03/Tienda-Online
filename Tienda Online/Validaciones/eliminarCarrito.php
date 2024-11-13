<?php

require_once '../Controlador/ControlProducto.php';
session_start();
$control = new ControlProducto();
$keyEliminar=0;
$nombreProducto=$control->getProducto($_GET["id"])->getNombre();
foreach($_SESSION['carrito'] as $key => $productos){
    $nombreProductoBD=$control->getProducto($productos[0])->getNombre();
    if($nombreProductoBD==$nombreProducto){
        $keyEliminar=$key;
    }
}
$_SESSION['carrito'][$keyEliminar][1]--;
foreach($_SESSION['carrito'] as $key => $productos){
    if($productos[1]<=0){
        unset($_SESSION['carrito'][$keyEliminar]);
    }
}




header("location: ../Vista/carrito.php");

?>