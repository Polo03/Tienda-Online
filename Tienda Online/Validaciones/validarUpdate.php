<?php

require_once '../Controlador/ControlProducto.php';
require_once '../Modelo/DTOProducto.php';

$controlador= new ControlProducto();
$producto=new DTOProducto($_POST['id'], $_POST['nombre'], $_POST['descripcion'], $_POST['precio'], $_POST['imagen']);
$controlador->modificarProducto($producto);

?>