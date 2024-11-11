<?php
require '../Modelo/ProductoDAO.php';
class ControlProducto{
    public function __construct() {
        $this->productoDAO = new ProductoDAO();
    }
    public function getProducto($id) {
        return $this->productoDAO->getProductoById($id);
    }
    public function getAllProductos() {
        return $this->productoDAO->getAllProductos();
    }
    public function crearProducto($producto) {
        if($this->productoDAO->getProductoByName($producto->getNombre()) !== null){
            echo "<p>Producto ya registrado</p>";
            return false;
        }
        elseif($producto->getPrecio() <= 0){
            echo "<p>El precio no puede ser menor a 0</p>";
            return false;
        }
        else {
            $this->productoDAO->addProducto($producto);
            echo "<p>Nuevo producto creado exitosamente</p>";
            return true;
        }
    }
    public function modificarProducto($producto) {
        $this->productoDAO->updateProducto($producto);
        header("Location: ../Vista/tienda.php");
    }
    public function eliminarProducto($producto) {
        if($this->productoDAO->getProductoById($producto->getId()) !== null){
            $this->productoDAO->deleteProducto($producto);
            echo "<p>Producto eliminado</p>";
        }
        else{
            echo "<p>El producto no existe</p>";
        }
    }
}
?>