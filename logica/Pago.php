<?php

class Pago {
    private $idPago;
    private $idCuenta;
    private $fechaPago;
    private $montoPagado;

    public function __construct($idPago = 0,$idCuenta = 0,$fechaPago = "",$montoPagado = 0.00) {
        $this->idPago = $idPago;
        $this->idCuenta= $idCuenta;
        $this->fechaPago = $fechaPago;
        $this->montoPagado = $montoPagado;
    }

    public function getIdPago() {
        return $this->idPago;
    }

    public function getIdCuenta() {
        return $this->idCuenta;
    }

    public function getFechaPago() {
        return $this->fechaPago;
    }

    public function getMontoPagado() {
        return $this->montoPagado;
    }

   
}

?>