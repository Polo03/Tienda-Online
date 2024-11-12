<?php

require_once '../Controlador/ControladorProducto.php';
require_once '../Modelo/DTOProducto.php';

$controlador= new ControladorProducto();
$producto=new DTOProducto($_POST['id'], $_POST['nombre'], $_POST['descripcion'], $_POST['precio'], $_POST['imagen']);
$controlador->eliminarProducto($producto);

?>