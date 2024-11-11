<?php
class DTOProducto
{
    private $id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $imagen;

    public function __construct($id, $nombre, $descripcion, $precio, $imagen)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
        $this->imagen = $imagen;
    }

    public function getId()
    {
        return $this->id;
    }


    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }


    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }


    public function getPrecio()
    {
        return $this->precio;
    }


    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }


    public function getImagen()
    {
        return $this->imagen;
    }


    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }

}
?>