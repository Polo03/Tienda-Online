<?php
session_start();
require_once '../Modelo/Cliente.php';
require_once '../Modelo/ClienteDAO.php';
require_once '../Controlador/ControladorCliente.php';

$controlador = new ControladorCliente();

$controlador->validarDatosLogin($_POST["user"], $_POST["pass"]);

$conn = null;
?>