<?php

require_once 'db.php';
require_once 'DTOCompra.php';

class CompraDAO {
    private $conn;
    public function __construct() {
        $this->conn = db::getConnection();
    }
    public function getCompraById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM compra WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $fila = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($fila) {
            return new DTOCompra($fila['id'], $fila['cliente_id'], $fila['producto_id'], $fila['fecha_compra'], $fila['cantidad']);
        } else {
            return null; // Si no se encuentra, devolvemos null
        }
    }

    // Metodo que retorna una lista de empleados como objetos DTOEmpleado
    public function getAllCompras() {
        $stmt = $this->conn->prepare("SELECT * FROM compra");
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $compras = [];
        foreach ($resultados as $fila) {
            $compra = new DTOCompra($fila['id'], $fila['cliente_id'], $fila['producto_id'], $fila['fecha_compra'], $fila['cantidad']);
            $compras[] = $compra;
        }

        return $compras; // Retornamos una lista de objetos DTOEmpleado
    }
    public function getAllComprasByIdCliente($idCliente) {
        $stmt = $this->conn->prepare("SELECT * FROM compra where cliente_id = :idCliente");
        $stmt->bindParam(':idCliente', $idCliente, PDO::PARAM_INT);
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $compras = [];
        foreach ($resultados as $fila) {
            $compra = new DTOCompra($fila['id'], $fila['cliente_id'], $fila['producto_id'], $fila['fecha_compra'], $fila['cantidad']);
            $compras[] = $compra;
        }

        return $compras; // Retornamos una lista de objetos DTOEmpleado
    }
    public function getLastId(){
        // Consulta SQL para obtener el último ID insertado
        $consulta = $this->conn->query("SELECT MAX(id) AS ultimo_id FROM compra");

        // Obtener el resultado de la consulta
        $resultado = $consulta->fetch(PDO::FETCH_ASSOC);

        // Devolver el último ID
        return $resultado['ultimo_id'];
    }
    public function addCompra($compra) {
        $queryCliente = "SELECT id FROM cliente WHERE id = :cliente_id";
        $stmtCliente = $this->conn->prepare($queryCliente);
        $stmtCliente->execute([':cliente_id' => $compra->getClienteId()]);

        // Verificar si el producto_id existe en la tabla producto
        $queryProducto = "SELECT id FROM producto WHERE id = :producto_id";
        $stmtProducto = $this->conn->prepare($queryProducto);
        $stmtProducto->execute([':producto_id' => $compra->getProductoId()]);

        if ($stmtCliente->rowCount() > 0 && $stmtProducto->rowCount() > 0) {
            $stmt = $this->conn->prepare("INSERT INTO compra (cliente_id, producto_id, fecha_compra, cantidad) VALUES (:cliente_id, :producto_id, :fecha_compra, :cantidad)");
            //$stmt->bindParam(':id', $cliente->getId());
            $cliente_id = $compra->getClienteId();
            $producto_id = $compra->getProductoId();
            $fecha_compra = $compra->getFechaCompra();
            $cantidad = $compra->getCantidad();
            echo $fecha_compra;
            $stmt->bindParam(':cliente_id', $cliente_id);
            $stmt->bindParam(':producto_id', $producto_id);
            $stmt->bindParam(':fecha_compra', $fecha_compra);
            $stmt->bindParam(':cantidad', $cantidad);
            return $stmt->execute();
        }



    }
}
?>
