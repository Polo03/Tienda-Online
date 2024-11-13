<?php
class DTOCompra
{
    private $id;
    private $cliente_id;
    private $producto_id;
    private $fecha_compra;
    private $cantidad;

    public function __construct($id, $cliente_id, $producto_id, $fecha_compra, $cantidad)
    {
        $this->id = $id;
        $this->cliente_id = $cliente_id;
        $this->producto_id = $producto_id;
        $this->fecha_compra = $fecha_compra;
        $this->cantidad = $cantidad;
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

    public function getProductoId()
    {
        return $this->producto_id;
    }


    public function setProductoId($producto_id)
    {
        $this->producto_id = $producto_id;
    }


    public function getFechaCompra()
    {
        return $this->fecha_compra;
    }

    public function setFechaCompra($fecha_compra)
    {
        $this->fecha_compra = $fecha_compra;
    }


    public function getCantidad()
    {
        return $this->cantidad;
    }

    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    }


}
?>