<?php
require_once '../Controlador/ControladorCompras.php';
require_once '../Controlador/ControladorCliente.php';
require_once '../Modelo/DTOCompra.php';
require_once '../Modelo/Cliente.php';
session_start();
$controladorCliente = new ControladorCliente();
$id_cliente = $controladorCliente->getIdCliente($_SESSION['cliente']->getUsuario());

$fecha_hora_con_dia = date('d-m-Y H:i:s');

if($id_cliente!=null){
    if(isset($_POST['comprar'])){
        foreach($_SESSION['carrito'] as $productos){
            $compra=new DTOCompra(0,$id_cliente, $productos[0], $fecha_hora_con_dia, $productos[1]);
            $controlador=new ControladorCompras();
            $controlador->registrarCompra($compra);
        }
        $_SESSION['carrito']=[];
    }
}

header("Location: ../Vista/tienda.php");

?>