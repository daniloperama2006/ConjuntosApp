<?php
require_once __DIR__ . "/../persistencia/PagoDAO.php";
require_once __DIR__ . "/../persistencia/Conexion.php";

class Pago {
    private $idPago;
    private $idCuenta;
    private $fechaPago;
    private $montoPagado;
    private $idPropietario;
    
    public function __construct($idPago = 0,$idCuenta = 0,$fechaPago = "",$montoPagado = 0.00, $idPropietario=0) {
        $this->idPago = $idPago;
        $this->idCuenta= $idCuenta;
        $this->fechaPago = $fechaPago;
        $this->montoPagado = $montoPagado;
        $this->idPropietario = $idPropietario;
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
    
    public function getIdPropietario() {
        return $this->idPropietario;
    }
    
    public function consultarPorPropiedad($idPropietario, $numeroApartamento) {
        $dao = new PagoDAO();
        $conexion = new Conexion();
        $conexion->abrir();
        $resultado = $conexion->ejecutar($dao->consultarPorPropiedad($idPropietario, $numeroApartamento));
        
        $pagos = [];
        
        while (($registro = $conexion->registro($resultado)) != null) {
            $pagos[] = new Pago($registro[0], $registro[1], $registro[2], $registro[3]);
        }
        
        $conexion->cerrar();
        return $pagos;
    }
    
    
    public function consultarPagosPorPropietario($numeroApartamento) {
        $dao = new PagoDAO();
        $conexion = new Conexion();
        $conexion->abrir();
        $resultado = $conexion->ejecutar($dao->consultarPagosPorPropietario($numeroApartamento));
        
        $pagos = [];
        
        while (($registro = $conexion->registro($resultado)) != null) {
            $pagos[] = new Pago($registro[0], $registro[1], $registro[2], $registro[3]);
        }
        
        $conexion->cerrar();
        return $pagos;
    }
    
}

?>