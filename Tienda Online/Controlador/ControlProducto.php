<?php
require_once '../Modelo/ProductoDAO.php';
require_once '../Controlador/ControlSubida.php';
class ControlProducto{
    public function __construct() {
        $this->productoDAO = new ProductoDAO();
        $this->controlSubida=new ControlSubida();
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
            $ruta=$this->controlSubida->proceso();
            $producto->setId($this->productoDAO->getLastId()+1);
            if($ruta!=-1){
                $producto->setImagen($ruta);
                $this->productoDAO->addProducto($producto);
                header("location: ../Vista/tienda.php");
                return true;
            }else{
                // Datos de ejemplo
                $error = 'La imagen ya esta siendo utilizada por otro producto';
                $id = $producto->getId();
                header("Location: ../Vista/insertarProducto.php?error=$error");
                return false;
            }
        }
    }
    public function modificarProducto($producto) {
        if($this->productoDAO->getProductoByIdAndName($producto->getId(),$producto->getNombre()) !== null){
            // Datos de ejemplo
            $error = 'Producto con nombre existente';
            $id = $producto->getId();
            print_r($producto);
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
            $id = $this->productoDAO->getIdProductoByName($producto->getNombre());
            $rutaAnterior = $this->productoDAO->getProductoById($id)->getImagen();
            unlink('C:/xampp/htdocs/Ejercicios/PHPStorm/Tienda Online/Tienda Online/'.substr($rutaAnterior,3));
            $ruta=$this->controlSubida->procesoActualizar($producto);
            if($ruta!=-1){
                $producto->setImagen($ruta);
                $this->productoDAO->updateProducto($producto);
                header("location: ../Vista/tienda.php");
                return true;
            }else{
                // Datos de ejemplo
                $error = 'La imagen ya esta siendo utilizada por otro producto';
                $id = $producto->getId();
                header("Location: ../Vista/modificarProducto.php?error=$error&id=$id");
                return false;
            }

        }
    }
    public function eliminarProducto($producto) {
        $id = $this->productoDAO->getIdProductoByName($producto->getNombre());
        $rutaAnterior = $this->productoDAO->getProductoById($id)->getImagen();
        unlink('C:/xampp/htdocs/Ejercicios/PHPStorm/Tienda Online/Tienda Online/'.substr($rutaAnterior,3));
        $this->productoDAO->deleteProducto($producto);
        header("location: ../Vista/tienda.php");
    }

    public function getControlSubida(): ControlSubida
    {
        return $this->controlSubida;
    }

}
?>