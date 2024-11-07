<?php
require '../Modelo/ClienteDAO.php';
class ControlCliente{
    public function __construct() {
        $this->clienteDAO = new ClienteDAO();
    }
    /*public function getEmpleado($id) {
        return $this->empleadoDAO->getEmpleadoById($id);
    }
    public function getEmpleados() {
        return $this->empleadoDAO->getAllEmpleados();
    }*/

    public function crearCliente($cliente) {
        if ($cliente->getEdad() > 18) {
            $this->clienteDAO->addCliente($cliente);
            return true;
        } else {
            return false;
        }
    }

    /*public function eliminarEmpleado($id) {
        if(self::getEmpleado($id)){
            $this->empleadoDAO->deleteEmpleado($id);
            return 1;
        }
        else {
            return -1;
        }
    }*/

    /*public function actualizarEmpleado($empleado) {
        if ($empleado->edad > 18) {
            return $this->empleadoDAO->updateEmpleado($empleado);
        } else {
            return false;
        }
    }*/
}
?>
