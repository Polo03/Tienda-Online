<?php
require_once '../Modelo/ProductoDAO.php';
require_once '../Modelo/Producto.php';
class ControladorProducto {
    private $productoDAO;

    public function __construct() {
        $this->productoDAO=new ProductoDAO();
    }

    // Validar los datos del cliente
    public static function validarDatosInsertarProducto($nombre, $descripcion, $precio, $imagen) {
        $errores = [];

        // Validación de que no estén vacíos
        if (empty($nombre) || empty($descripcion) || empty($precio) || empty($imagen)) {
            $errores[] = "Rellena todos los campos.";
        }

        // Validación de nombre: solo letras
        if (!empty($nombre) && !preg_match('/^[a-zA-Z]+$/', $nombre)) {
            $errores[] = "El nombre solo debe contener letras.";
        }

        // Validación de descripcion: solo caracteres alfanuméricos
        if (!empty($descripcion) && !preg_match('/^[a-zA-Z0-9]+$/', $descripcion)) {
            $errores[] = "La descripcion solo debe contener caracteres alfanuméricos.";
        }

        // Validación de precio: solo números
        if (!empty($precio) && !ctype_digit($precio)) {
            $errores[] = "El precio debe contener solo número.";
        }

        return $errores;
    }

    public static function validarDatosUpdateProducto($nombre, $descripcion, $precio, $imagen) {
        $errores = [];

        // Validación de que no estén vacíos
        if (empty($nombre) || empty($descripcion) || empty($precio) || empty($imagen)) {
            $errores[] = "Rellena todos los campos.";
        }

        // Validación de nombre: solo letras
        if (!empty($nombre) && !preg_match('/^[a-zA-Z]+$/', $nombre)) {
            $errores[] = "El nombre solo debe contener letras.";
        }

        // Validación de descripcion: solo caracteres alfanuméricos
        if (!empty($descripcion) && !preg_match('/^[a-zA-Z0-9]+$/', $descripcion)) {
            $errores[] = "La descripcion solo debe contener caracteres alfanuméricos.";
        }

        // Validación de precio: solo números
        if (!empty($precio) && !ctype_digit($precio)) {
            $errores[] = "El precio debe contener solo número.";
        }

        return $errores;
    }
    public function __destruct() {
        $this->conn = null; // Cerrar la conexión
    }
}
?>