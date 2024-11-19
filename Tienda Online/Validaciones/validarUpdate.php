<?php

require_once '../Controlador/ControladorProducto.php';
require_once '../Controlador/ControlProducto.php';
require_once '../Modelo/DTOProducto.php';

if(isset($_POST["salir"])){
    header("location: ../Vista/tienda.php");
}else{

    if (isset($_FILES['ficheroSubida']) && $_FILES['ficheroSubida']['error'] == 0) {
        $controlProducto = new ControlProducto();
        $rutaCompleta=$controlProducto->getControlSubida()->getRutaCompleta();
        $producto = new DTOProducto($_POST['id'], $_POST['nombre'], $_POST['descripcion'], $_POST['precio'], $rutaCompleta);
        $controlador = new ControladorProducto();
        $controlador->actualizarProducto($producto);
    }else{
        header("location: ../Vista/modificarProducto.php?error=Rellena todos los campos&id=".$_POST['id']);
    }
}




?>