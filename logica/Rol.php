<?php

class Rol{
    private $idRol;
    private $nombreRol;

    public function __construct($idRol = 0, $nombreRol = "") {
        $this->idRol = $idRol;
        $this->nombreRol = $idRol;
    }
    public function getNombreRol(){
        return $this -> nombreRol;
    }
}

?>