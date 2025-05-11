<?php

class Apartamento {
    private $idApartamento;
    private $numero;
    private $bloque;
    private $propietario;

    public function __construct($idApartamento = 0,$numero = 0,$bloque = 0,$propietario = 0) {
        $this->idApartamento = $idApartamento;
        $this->numero= $numero;
        $this->bloque = $bloque;
        $this->propietario = $propietario;
    }

    public function getIdApartamento(){
        return $this->idApartamento;
    }

    public function getNumero(){
        return $this->numero;
    }

    public function getBloqueInt(){
        return $this->bloque;
    }

    public function getPropietario(){
        return $this->propietario;
    }


}