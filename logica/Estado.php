<?php

class Estado{
    private $idEstado;
    private $nombreEstado;

    public function __construct($idEstado= 0, $nombreEstado = "") {
        $this->idEstado = $idEstado;
        $this->nombreEstado = $nombreEstado;
    }
    
    public function getIdEstado(){
        return $this -> idEstado;
    }
    public function getNombreEstado(){
        return $this -> nombreEstado;
    }
}

?>