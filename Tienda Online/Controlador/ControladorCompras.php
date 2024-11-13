<?php
require_once '../Controlador/ControlCompras.php';
class ControladorCompras {
    private $controlCompra;

    public function __construct() {
        $this->controlCompra=new ControlCompras();
    }

    // Insertar el producto en la base de datos si los datos son válidos
    public function registrarCompra($compra) {
        $this->controlCompra->crearCompra($compra);
    }


}
?>