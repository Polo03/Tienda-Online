<?php
class DTOCliente {
    private $id;
    private $nombre;
    private $apellido;
    private $nickname;
    private $password;
    private $telefono;
    private $domicilio;

    public function __construct($nombre, $apellido, $nickname, $password, $telefono, $domicilio) {
        // $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->nickname = $nickname;
        $this->password = $password;
        $this->telefono = $telefono;
        $this->domicilio = $domicilio;
    }


    // Getters

    public function getId()
    {
        return $this->id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function getNickname()
    {
        return $this->nickname;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function getDomicilio()
    {
        return $this->domicilio;
    }

    //Setters

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    public function setNickname($nickname)
    {
        $this->nickname = $nickname;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    public function setDomicilio($domicilio)
    {
        $this->domicilio = $domicilio;
    }
}
?>
