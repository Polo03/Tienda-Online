<?php
require_once '../Controlador/ControladorProducto.php';
require_once '../Controlador/ControlProducto.php';
require_once '../Modelo/DTOProducto.php';

if (isset($_POST['accion'])) {
    $accion = $_POST['accion']; // El valor del botón presionado

    switch ($accion) {
        case 'cerrar':
            header("location: ../Vista/tienda.php");
            break;
        case 'insertar':
            if (isset($_POST['precio']) && isset($_POST['nombre']) && isset($_POST['descripcion']) && isset($_FILES['ficheroSubida']) && $_FILES['ficheroSubida']['error'] == 0) {
                $controlProducto = new ControlProducto();
                $rutaCompleta=$controlProducto->getControlSubida()->getRutaCompleta();
                $producto = new DTOProducto(0, $_POST['nombre'], $_POST['descripcion'], $_POST['precio'], null);
                $controlador = new ControladorProducto();
                $controlador->registrarProducto($producto);
            }else{
                header("location: ../Vista/insertarProducto.php?error=Rellena todos los campos");
            }
            break;
    }
}
?>