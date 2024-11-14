<?php
require_once '../Modelo/CompraDAO.php';
class ControlCompras{
    public function __construct() {
        $this->compraDAO = new CompraDAO();
    }
    public function getCompra($id) {
        return $this->compraDAO->getCompraById($id);
    }
    public function getAllCompras() {
        return $this->compraDAO->getAllCompras();
    }
    public function getAllComprasByIdCliente($idCliente) {
        return $this->compraDAO->getAllComprasByIdCliente($idCliente);
    }
    public function crearCompra($compra) {
        $compra->setId($this->compraDAO->getLastId()+1);
        $this->compraDAO->addCompra($compra);
//        header("location: ../Vista/tienda.php");
        return true;
    }


}
?>