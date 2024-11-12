<?php
require_once '../Controlador/ControlProducto.php';
class ControladorProducto {
    private $controlProducto;

    public function __construct() {
        $this->controlProducto=new ControlProducto();
    }

    // Insertar el producto en la base de datos si los datos son válidos
    public function registrarProducto($producto) {
        $this->controlProducto->crearProducto($producto);
    }

}
?>