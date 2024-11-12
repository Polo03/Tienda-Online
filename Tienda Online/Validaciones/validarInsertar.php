<?php
require_once '../Controlador/ControladorProducto.php';
require_once '../Modelo/DTOProducto.php';

if (isset($_POST['accion'])) {
    $accion = $_POST['accion']; // El valor del botón presionado

    switch ($accion) {
        case 'cerrar':
            header("location: ../Vista/tienda.php");
            break;
        case 'insertar':
            if($_POST['precio']!='' && $_POST['nombre']!='' && $_POST['descripcion']!='' && $_POST['imagen']!=''){
                $producto = new DTOProducto(0, $_POST['nombre'], $_POST['descripcion'], $_POST['precio'], $_POST['imagen']);

                $controlador = new ControladorProducto();
                $controlador->registrarProducto($producto);
            }else{
                header("location: ../Vista/insertarProducto.php?error=Rellena todos los campos");
            }
            break;
    }
}
?>