<?php

class Estado{
    private $idEstado;
    private $nombreEstado;

    public function __construct($idEstado= 0, $nombreEstado = "") {
        $this->idEstado = $idEstado;
        $this->nombreEstado = $idEstado;
    }
    public function getNombreRol(){
        return $this -> nombreEstado;
    }
}

?>