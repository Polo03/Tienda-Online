<?php
require_once 'db.php';
require_once 'DTOProducto.php';

class ProductoDAO {
    private $conn;
    public function __construct() {
        $this->conn = db::getConnection();
    }
    public function getProductoById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM producto WHERE id = :id");
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

    public function getLastId(){
        // Consulta SQL para obtener el último ID insertado
        $consulta = $this->conn->query("SELECT MAX(id) AS ultimo_id FROM producto");

        // Obtener el resultado de la consulta
        $resultado = $consulta->fetch(PDO::FETCH_ASSOC);

        // Devolver el último ID
        return $resultado['ultimo_id'];
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
        $stmt = $this->conn->prepare("INSERT INTO producto (id, nombre, descripcion, precio, imagen) VALUES (:id, :nombre, :descripcion, :precio, :imagen)");
        $id = $producto->getId();
        $nombre = $producto->getNombre();
        $descripcion = $producto->getDescripcion();
        $precio = $producto->getPrecio();
        $imagen = $producto->getImagen();
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':precio', $precio);
        $stmt->bindParam(':imagen', $imagen);
        return $stmt->execute();
    }
    public function updateProducto($producto) {
        $stmt = $this->conn->prepare("UPDATE producto SET nombre = :nombre, descripcion =:descripcion, precio = :precio, imagen = :imagen WHERE id = :id");
        $id = $producto->getId();
        $nombre = $producto->getNombre();
        $descripcion = $producto->getDescripcion();
        $precio = $producto->getPrecio();
        $imagen = $producto->getImagen();
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':precio', $precio);
        $stmt->bindParam(':imagen', $imagen);
        return $stmt->execute();
    }

    public function deleteProducto($producto) {
        try {
            $sql = "DELETE FROM producto WHERE nombre = :nombre";
            $stmt = $this->conn->prepare($sql);

            // Extraer el atributo 'nombre' del objeto $producto y pasarlo al bindParam
            $nombreProducto = $producto->getNombre();
            $stmt->bindParam(':nombre', $nombreProducto);

            $stmt->execute();
            return $stmt->rowCount() > 0; // Retorna true si se eliminó alguna fila
        } catch (PDOException $e) {
            echo "Error al eliminar el producto: " . $e->getMessage();
            return false;
        }
    }}
?>
