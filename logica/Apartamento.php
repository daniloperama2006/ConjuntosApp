<?php

class Apartamento {
    private $idApartamento;
    private $numero;
    private $propietario;

    public function __construct($idApartamento = 0,$numero = 0,$bloque = 0,$propietario = 0) {
        $this->idApartamento = $idApartamento;
        $this->numero= $numero;
        $this->propietario = $propietario;
    }

    public function getIdApartamento(){
        return $this->idApartamento;
    }

    public function getNumero(){
        return $this->numero;
    }

    public function getPropietario(){
        return $this->propietario;
    }


    public function consultarPorNumero() {
    require_once 'persistencia/Conexion.php';
    require_once 'persistencia/ApartDAO.php';

    $dao = new ApartDAO(0, $this->numero);
    $conexion = new Conexion();
    $conexion->abrir();
    $resultado = $conexion->ejecutar($dao->consultarPorNumero());

    if ($registro = $conexion->registro($resultado)) {
        $this->idApartamento = $registro[0];
        $this->numero = $registro[1];
        $this->propietario = $registro[2];
        $conexion->cerrar();
        return true;
    } else {
        $conexion->cerrar();
        return false;
    }
}


}