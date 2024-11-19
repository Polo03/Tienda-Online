<?php

if(isset($_GET["id_detalles"])){
    header('location: ../Vista/detallesProducto.php?id='.$_GET['id_detalles']);
}
if(isset($_GET["id_carrito"])){
    header('location: ../Validaciones/anyadirCarrito.php?id='.$_GET['id_carrito']);
}
if(isset($_GET["id_modificar"])){
    header('location: ../Vista/modificarProducto.php?id_modificar='.$_GET['id_modificar']);
}
if(isset($_GET["id_eliminar"])){
    header('location: ../Vista/eliminarProducto.php?id='.$_GET['id_eliminar']);
}

?>