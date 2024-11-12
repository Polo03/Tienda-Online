<?php
require_once '../Controlador/ControladorProducto.php';
require_once '../Modelo/DTOProducto.php';
//require_once '../Modelo/DAO/ProductoDAO.php';

/*$lastId=new ProductoDAO();
$lastId->getLastId();*/

$producto = new DTOProducto(0, $_POST['nombre'], $_POST['descripcion'], $_POST['precio'], $_POST['imagen']);

$controlador = new ControladorProducto();
$controlador->registrarProducto($producto);

?>