<?php
require_once '../Controlador/ControladorCompras.php';
require_once '../Controlador/ControladorCliente.php';
require_once '../Controlador/ControlProducto.php';
require_once '../Modelo/DTOCompra.php';
session_start();
$controladorCliente = new ControladorCliente();
$id_cliente = $controladorCliente->getIdCliente($_SESSION['cliente']);

$fecha_hora_con_dia = date('d-m-Y H:i:s');
$control=new ControlProducto();
$totalPrecioCompra=0;
foreach($_SESSION['carrito'] as $productos){
    $producto=$control->getProducto($productos[0]);
    $totalPrecioCompra+=$producto->getPrecio()*$productos[1];
}

$id_productos="";
$cantidades="";
if($id_cliente!=null){
    if(isset($_POST['comprar'])){
        foreach($_SESSION['carrito'] as $i => $productos){
            if($i==count($_SESSION['carrito'])-1){
                $id_productos.=$productos[0];
                $cantidades.=$productos[1];
            }else{
                $id_productos.=$productos[0] . ' ';
                $cantidades.=$productos[1] . ' ';
            }

        }
        $_SESSION['carrito']=[];
        $compra=new DTOCompra(0,$id_cliente, $id_productos, $fecha_hora_con_dia, $cantidades, $totalPrecioCompra);
        $controlador=new ControladorCompras();
        $controlador->registrarCompra($compra);
    }

}
if(isset($_POST['borrarCarrito'])){
    $_SESSION['carrito']=[];
}

header("Location: ../Vista/tienda.php");

?>