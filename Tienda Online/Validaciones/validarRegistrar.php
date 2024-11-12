<?php
require_once '../Controlador/ControladorCliente.php';
require_once '../Modelo/DTOCliente.php';

$cliente=new DTOCliente($_POST['nombre'], $_POST['apellido'], $_POST['nickname'], $_POST['password'], $_POST['telefono'], $_POST['domicilio']);
$controlador = new ControladorCliente();
$controlador->registrarCliente($cliente);
?>