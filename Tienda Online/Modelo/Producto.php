<?php
// Archivo Cliente.php

class Cliente {
    private $nombre;
    private $descripcion;
    private $precio;
    private $imagen;

    public function __construct($nombre, $descripcion, $precio, $imagen) {
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
        $this->imagen = $imagen;
    }

    public function getNombre() {
        return $this->nombre;
    }
    public function getDescripcion() {
        return $this->descripcion;
    }
    public function getPrecio() {
        return $this->precio;
    }
    public function getImagen() {
        return $this->imagen;
    }



}
?>