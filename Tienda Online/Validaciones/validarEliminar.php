<?php

require_once '../Controlador/ControladorProducto.php';
require_once '../Modelo/DTOProducto.php';
require_once '../Modelo/ProductoDAO.php';
if(isset($_POST["salir"])){
    header("location: ../Vista/tienda.php");
}else{
    $productoDao=new ProductoDAO();
    $ruta=$productoDao->getProductoById($_POST["id"])->getImagen();
    $controlador= new ControladorProducto();
    $producto=new DTOProducto($_POST['id'], $_POST['nombre'], $_POST['descripcion'], $_POST['precio'], $ruta);
    unlink($ruta);
    $controlador->eliminarProducto($producto);
}


?>