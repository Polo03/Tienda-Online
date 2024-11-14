<?php
require_once '../Modelo/ClienteDAO.php';
class ControlCliente{
    public function __construct() {
        $this->clienteDAO = new ClienteDAO();
    }

    public function crearCliente($cliente) {

        if($this->clienteDAO->getClienteByNickname($cliente->getNickname()) !== null){
            header("location: ../Vista/registrar.php?error=Usuario ya registrado");
            return false;
        }
        else {
            $this->clienteDAO->addCliente($cliente);
            // Crear una nueva instancia de la clase Cliente
            $nuevoCliente = new Cliente($cliente->getNickname(), $cliente->getPassword());

            // Guardar el objeto Usuario en la sesión
            $_SESSION['cliente'] = $nuevoCliente;


            header('location: ../Vista/tienda.php');
            return true;
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