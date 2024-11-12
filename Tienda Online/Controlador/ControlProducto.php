<?php
require_once '../Modelo/ProductoDAO.php';
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
            header("location: ../Vista/insertarProducto.php?error=Producto ya registrado");
            return false;
        }
        elseif($producto->getPrecio() <= 0){
            header("location: ../Vista/insertarProducto.php?error=El precio no puede ser menor a 0");
            echo "<p>El precio no puede ser menor a 0</p>";
            return false;
        }
        else {
            $producto->setId($this->productoDAO->getLastId()+1);
            $this->productoDAO->addProducto($producto);
            echo "<p>Nuevo producto creado exitosamente</p>";
            header("location: ../Vista/tienda.php");
            return true;
        }
    }
    public function modificarProducto($producto) {
        if($this->productoDAO->getProductoByIdAndName($producto->getId(),$producto->getNombre()) !== null){
            // Datos de ejemplo
            $error = 'Producto con nombre existente';
            $id = $producto->getId();

            header("Location: ../Vista/modificarProducto.php?error=$error&id=$id");
            return false;
        }
        elseif($producto->getPrecio() <= 0){
            // Datos de ejemplo
            $error = 'El precio no puede ser menor a 0';
            $id = $producto->getId();
            header("Location: ../Vista/modificarProducto.php?error=$error&id=$id");
            return false;
        }
        else {
            $this->productoDAO->updateProducto($producto);
            header("location: ../Vista/tienda.php");
            return true;
        }
    }
    public function eliminarProducto($producto) {
        $this->productoDAO->deleteProducto($producto);
        header("location: ../Vista/tienda.php");
    }
}
?>