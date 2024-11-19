<?php
class DTOCompra
{
    private $id;
    private $cliente_id;
    private $productos;
    private $fecha_compra;
    private $cantidades;
    private $precio_compra;

    public function __construct($id, $cliente_id, $productos, $fecha_compra, $cantidades, $precio_compra)
    {
        $this->id = $id;
        $this->cliente_id = $cliente_id;
        $this->productos = $productos;
        $this->fecha_compra = $fecha_compra;
        $this->cantidades = $cantidades;
        $this->precio_compra = $precio_compra;
    }

    public function getId()
    {
        return $this->id;
    }


    public function setId($id)
    {
        $this->id = $id;
    }


    public function getClienteId()
    {
        return $this->cliente_id;
    }


    public function setClienteId($cliente_id)
    {
        $this->cliente_id = $cliente_id;
    }

    public function getProductoS()
    {
        return $this->productos;
    }


    public function setProductos($productos)
    {
        $this->productos = $productos;
    }


    public function getFechaCompra()
    {
        return $this->fecha_compra;
    }

    public function setFechaCompra($fecha_compra)
    {
        $this->fecha_compra = $fecha_compra;
    }


    public function getCantidades()
    {
        return $this->cantidades;
    }

    public function setCantidades($cantidades)
    {
        $this->cantidades = $cantidades;
    }

    public function getPrecioCompra()
    {
        return $this->precio_compra;
    }

    public function setPrecioCompra($precio_compra)
    {
        $this->precio_compra = $precio_compra;
    }


}
?>