<?php
// Archivo Cliente.php

class Cliente {
    private $usuario;
    private $contraseña;

    public function __construct($usuario, $contraseña) {
        $this->usuario = $usuario;
        $this->contraseña = $contraseña;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    // Método solo para prueba; no deberías mostrar contraseñas en producción.
    public function mostrarInfo() {
        return "Usuario: " . $this->usuario . ", Contraseña: " . $this->contraseña;
    }
}
?>