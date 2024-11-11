<?php
require_once 'db.php';
require_once 'DTOProducto.php';

class ProductoDAO {
    private $conn;
    public function __construct() {
        $this->conn = db::getConnection();
    }
    public function getProductoById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM productos WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $fila = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($fila) {
            return new DTOProducto($fila['id'], $fila['nombre'], $fila['descripcion'], $fila['precio'],$fila['imagen']);
        } else {
            return null; // Si no se encuentra, devolvemos null
        }
    }
    public function getProductoByName($nombre) {
        $stmt = $this->conn->prepare("SELECT * FROM producto WHERE nombre = :nombre");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->execute();
        $fila = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($fila) {
            return new DTOProducto($fila['id'], $fila['nombre'], $fila['descripcion'], $fila['precio'],$fila['imagen']);
        } else {
            return null; // Si no se encuentra, devolvemos null
        }
    }
    // Metodo que retorna una lista de empleados como objetos DTOEmpleado
    public function getAllProductos() {
        $stmt = $this->conn->prepare("SELECT * FROM producto");
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $productos = [];
        foreach ($resultados as $fila) {
            $producto = new DTOProducto($fila['id'], $fila['nombre'], $fila['descripcion'], $fila['precio'],$fila['imagen']);
            $productos[] = $producto;
        }

        return $productos; // Retornamos una lista de objetos DTOEmpleado
    }

    public function addProducto($producto) {
        $stmt = $this->conn->prepare("INSERT INTO producto (nombre, descripcion, precio, imagen) VALUES (:nombre, :descripcion, :precio, :imagen)");
        $nombre = $producto->getNombre();
        $descripcion = $producto->getDescripcion();
        $precio = $producto->getPrecio();
        $imagen = $producto->getImagen();
        //$stmt->bindParam(':id', $producto->getId());
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':precio', $precio);
        $stmt->bindParam(':imagen', $imagen);
        return $stmt->execute();
    }
    public function updateProducto($producto) {
        $stmt = $this->conn->prepare("UPDATE producto SET nombre = :nombre, descripcion =:descripcion, precio = :precio, imagen = :imagen WHERE id = :id");
        $stmt->bindParam(':id', $producto->getId());
        $stmt->bindParam(':nombre', $producto->getNombre());
        $stmt->bindParam(':descripcion', $producto->getDescripcion());
        $stmt->bindParam(':precio', $producto->getPrecio());
        $stmt->bindParam(':imagen', $producto->getImagen());
        return $stmt->execute();
    }

    public function deleteProducto($id) {
        $stmt = $this->conn->prepare("DELETE FROM producto WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>
