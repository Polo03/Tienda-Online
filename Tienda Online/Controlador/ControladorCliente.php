<?php
require_once '../Modelo/ClienteDAO.php';
require_once '../Modelo/Cliente.php';
require_once '../Controlador/ControlCliente.php';
class ControladorCliente {
    private $clienteDAO;
    private $controlCliente;

    public function __construct() {
        $this->clienteDAO=new ClienteDAO();
        $this->controlCliente=new ControlCliente();
    }

    public function getIdCliente($nickname){
        return $this->clienteDAO->getIdClienteByNickname($nickname);
    }

    public function getNombreClienteByNickname($nickname){
        return $this->clienteDAO->getNombreClienteByNickname($nickname);
    }

    public function validarDatosLogin($nickname, $password){
        try {
            if($this->clienteDAO->getClienteByNickname($nickname)){
                if($this->clienteDAO->getClienteByNicknameAndPassword($nickname, $password)){
                    // Guardar el objeto Usuario en la sesión
                    $_SESSION['cliente'] = $nickname;
                    header('location: ../Vista/tienda.php');
                }else{
                    header("location:../Vista/login.php?error=Inicio de sesion incorrecto.");
                    exit();
                }
            }else{
                header("location:../Vista/login.php?error=Usuario no existente.");
                exit();
            }
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Insertar el cliente en la base de datos si los datos son válidos
    public function registrarCliente($cliente) {
        $this->controlCliente->crearCliente($cliente);
    }

}
?>