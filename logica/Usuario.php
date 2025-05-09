<?php
class Usuario{
    private $idUsuario;
    private $nombre;
    private $apellido;
    private $correo;
    private $clave;
    private $idRol;

    public function __construct($idUsuario = 0, $nombre = "", $apellido = "", $correo = "", $clave = "", $idRol = 0) {
        $this->idUsuario = $idUsuario;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->correo = $correo;
        $this->clave = $clave;
        $this->idRol = $idRol;
    }

    public function getIdUsuario(): int
    {
        return $this->idUsuario;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function getApellido(): string
    {
        return $this->apellido;
    }

    public function getCorreo(): string
    {
        return $this->correo;
    }

    public function getClave(): string
    {
        return $this->clave;
    }

    public function getIdRol(): int
    {
        return $this->idRol;
    }
}

?>