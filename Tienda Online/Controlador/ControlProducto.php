<?php
require '../Modelo/ProductoDAO.php';
class ControlProducto{
    public function __construct() {
        $this->productoDAO = new ProductoDAO();
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
}
?>