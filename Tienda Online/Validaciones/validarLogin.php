<?php
session_start();
require_once '../Controlador/ControladorCliente.php';

$controlador = new ControladorCliente();

$controlador->validarDatosLogin($_POST["user"], $_POST["pass"]);

$conn = null;
?>