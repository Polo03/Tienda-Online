<?php

require_once '../Controlador/ControlProducto.php';
session_start();
$control = new ControlProducto();

$existe=false;
$keyAnyadir=0;
$nombreProducto=$control->getProducto($_GET["id"])->getNombre();
$productoArray=[$_GET["id"],1];
foreach($_SESSION['carrito'] as $key => $productos){
    $nombreProductoBD=$control->getProducto($productos[0])->getNombre();
    if($productos[1]==0){
        unset($_SESSION['carrito'][$productos]);

    }
    if($nombreProductoBD==$nombreProducto){
        $existe=true;
        $keyAnyadir=$key;
    }
}
if($existe)
    $_SESSION['carrito'][$keyAnyadir][1]++;
else{
    array_push($_SESSION["carrito"],$productoArray);
}


header("location: ../Vista/tienda.php");

?>