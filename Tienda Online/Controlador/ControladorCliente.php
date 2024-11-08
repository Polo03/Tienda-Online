<?php
require_once '../Modelo/ClienteDAO.php';
require_once '../Modelo/Cliente.php';
require_once '../Controlador/ControladorCliente.php';
class ControladorCliente {
    private $conn;
    private $clienteDAO;

    public function __construct() {
        /*try {
            $this->conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }*/
        $this->clienteDAO=new ClienteDAO();
    }

    // Validar los datos del cliente
    private function validarDatosRegistro($nombre, $apellido, $nickname, $password, $telefono, $domicilio) {
        $errores = [];

        // Validación de que no estén vacíos
        if (empty($nombre) && empty($apellido) && empty($nickname) && empty($password) && empty($telefono) && empty($domicilio)) {
            $errores[] = "Rellena todo.";
        }

        // Validación de nombre: solo letras
        if (!preg_match('/^[a-zA-Z]+$/', $nombre)) {
            $errores[] = "El nombre solo debe contener letras.";
        }

        // Validación de apellido: solo letras
        if (!preg_match('/^[a-zA-Z]+$/', $apellido)) {
            $errores[] = "El apellido solo debe contener letras.";
        }

        // Validación de nickname: solo caracteres alfanuméricos
        if (!preg_match('/^[a-zA-Z0-9]+$/', $nickname)) {
            $errores[] = "El nickname solo debe contener caracteres alfanuméricos.";
        }

        // Validación de contraseña: al menos 8 caracteres, con mayúsculas, minúsculas y números
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', $password)) {
            $errores[] = "La contraseña debe tener al menos 8 caracteres, incluyendo una letra mayúscula, una letra minúscula y un número.";
        }

        // Validación de teléfono: solo números
        if (!ctype_digit($telefono)) {
            $errores[] = "El teléfono debe contener solo números.";
        }

        return $errores;
    }
    public function validarDatosLogin($nickname, $password){
        try {
            if($this->clienteDAO->getClienteByNickname($nickname)){
                if($this->clienteDAO->getClienteByNicknameAndPassword($nickname, $password)){
                    // Crear una nueva instancia de la clase Usuario
                    $nuevoCliente = new Cliente($nickname, $password);

                    // Guardar el objeto Usuario en la sesión
                    $_SESSION['cliente'] = $nuevoCliente;

                    header('location: ../Vista/tienda.php');
                }else{
                    $error1= "Inicio de sesion incorrecto.";
                    header("location:../Vista/login.php?error1=$error1");
                    exit();
                }
            }else{
                $error2= "Usuario no existente.";
                header("location:../Vista/login.php?error2=$error2");
                exit();
            }
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Insertar el cliente en la base de datos si los datos son válidos
    public function registrarCliente($nombre, $apellido, $nickname, $password, $telefono, $domicilio) {
        // Validar datos
        $errores = $this->validarDatos($nombre, $apellido, $nickname, $password, $telefono, $domicilio);

        if (!empty($errores)) {
            return $errores; // Retornar errores para mostrarlos al usuario
        }

        try {
            $sql = "INSERT INTO cliente (nombre, apellido, nickname, password, telefono, domicilio) 
                    VALUES (:nombre, :apellido, :nickname, :password, :telefono, :domicilio)";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':apellido', $apellido);
            $stmt->bindParam(':nickname', $nickname);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':domicilio', $domicilio);

            $stmt->execute();
            return "Cliente registrado exitosamente.";
        } catch (PDOException $e) {
            return "Error al registrar el cliente: " . $e->getMessage();
        }
    }

    public function __destruct() {
        $this->conn = null; // Cerrar la conexión
    }
}
?>