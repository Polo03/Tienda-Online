<?php

require_once 'db.php';
require_once 'DTOCliente.php';

class ClienteDAO {
    private $conn;
    public function __construct() {
        $this->conn = db::getConnection();
    }
    public function getClienteById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM cliente WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $fila = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($fila) {
            return new DTOCliente($fila['id'], $fila['nombre'], $fila['apellido'], $fila['nickname'],$fila['password'], $fila['telefono'], $fila['domicilio']);
        } else {
            return null; // Si no se encuentra, devolvemos null
        }
    }
    public function getIdClienteByNickname($nickname) {
        $stmt = $this->conn->prepare("SELECT id FROM cliente WHERE nickname = :nickname");
        $stmt->bindParam(':nickname', $nickname);
        $stmt->execute();
        $fila = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($fila) {
            return $fila['id'];
        } else {
            return null; // Si no se encuentra, devolvemos null
        }
    }
    public function getNombreClienteByNickname($nickname) {
        $stmt = $this->conn->prepare("SELECT nombre FROM cliente WHERE nickname = :nickname");
        $stmt->bindParam(':nickname', $nickname);
        $stmt->execute();
        $fila = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($fila) {
            return $fila['nombre'];
        } else {
            return null; // Si no se encuentra, devolvemos null
        }
    }
    public function getClienteByNickname($nickname) {
        $stmt = $this->conn->prepare("SELECT * FROM cliente WHERE nickname = :nickname");
        $stmt->bindParam(':nickname', $nickname);
        $stmt->execute();
        $fila = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($fila) {
            return new DTOCliente($fila['id'], $fila['nombre'], $fila['apellido'], $fila['nickname'],$fila['password'], $fila['telefono'], $fila['domicilio']);
        } else {
            return null; // Si no se encuentra, devolvemos null
        }
    }
    public function getClienteByNicknameAndPassword($nickname, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM cliente WHERE nickname = :nickname and password = :password");
        $stmt->bindParam(':nickname', $nickname);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        $fila = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($fila) {
            return new DTOCliente($fila['id'], $fila['nombre'], $fila['apellido'], $fila['nickname'],$fila['password'], $fila['telefono'], $fila['domicilio']);
        } else {
            return null; // Si no se encuentra, devolvemos null
        }
    }
    // Metodo que retorna una lista de empleados como objetos DTOEmpleado
    public function getAllClientes() {
        $stmt = $this->conn->prepare("SELECT * FROM cliente");
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $clientes = [];
        foreach ($resultados as $fila) {
            $cliente = new DTOCliente($fila['id'], $fila['nombre'], $fila['apellido'], $fila['nickname'],$fila['password'], $fila['telefono'], $fila['domicilio']);
            $clientes[] = $cliente;
        }

        return $clientes; // Retornamos una lista de objetos DTOEmpleado
    }

    public function addCliente($cliente) {
        $stmt = $this->conn->prepare("INSERT INTO cliente (nombre, apellido, nickname, password, telefono, domicilio) VALUES (:nombre, :apellido, :nickname, :password, :telefono, :domicilio)");
        //$stmt->bindParam(':id', $cliente->getId());
        $nombre = $cliente->getNombre();
        $apellido = $cliente->getApellido();
        $nickname = $cliente->getNickname();
        $password = $cliente->getPassword();
        $telefono = $cliente->getTelefono();
        $domicilio = $cliente->getDomicilio();
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':nickname', $nickname);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':domicilio', $domicilio);
        return $stmt->execute();
    }

    public function updateCliente($cliente) {
        $stmt = $this->conn->prepare("UPDATE cliente SET nombre = :nombre, apellido = :apellido, nickname = :nickname, password = :password, telefono = :telefono, domicilio = :domicilio WHERE id = :id");
        $stmt->bindParam(':id', $cliente->getId());
        $stmt->bindParam(':nombre', $cliente->getNombre());
        $stmt->bindParam(':apellido', $cliente->getApellido());
        $stmt->bindParam(':nickname', $cliente->getNickname());
        $stmt->bindParam(':password', $cliente->getPassword());
        $stmt->bindParam(':telefono', $cliente->getTelefono());
        $stmt->bindParam(':domicilio', $cliente->getDomicilio());
        return $stmt->execute();
    }

    public function deleteCliente($id) {
        $stmt = $this->conn->prepare("DELETE FROM cliente WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>
