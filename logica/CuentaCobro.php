<?php

class CuentaCobro {
    private $id;
    private $idApartamento;
    private $idEstado;
    private $fechaGeneracion;
    private $valor;
    private $idAdministrador;
    private $creadoEn;
    private $actualizadoEn;

    public function __construct(
        $id = 0,
        $idApartamento = 0,
        $idEstado = 0,
        $fechaGeneracion = "",
        $valor = 0.00,
        $idAdministrador = 0
    ) {
        $this->id = $id;
        $this->idApartamento = $idApartamento;
        $this->idEstado = $idEstado;
        $this->fechaGeneracion = $fechaGeneracion;
        $this->valor = $valor;
        $this->idAdministrador = $idAdministrador;
    }

    public function getId() {
        return $this->id;
    }

    public function getIdApartamento() {
        return $this->idApartamento;
    }

    public function getIdEstado() {
        return $this->idEstado;
    }

    public function getFechaGeneracion() {
        return $this->fechaGeneracion;
    }

    public function getValor() {
        return $this->valor;
    }

    public function getIdAdministrador() {
        return $this->idAdministrador;
    }

    public function getCreadoEn() {
        return $this->creadoEn;
    }

    public function getActualizadoEn() {
        return $this->actualizadoEn;
    }

}

?>