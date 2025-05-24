<?php 
class PagoDAO {
    private $idPago;
    private $idCuenta;
    private $fechaPago;
    private $montoPagado;
    private $idPropietario;
    
    public function __construct($idPago = 0, $idCuenta = 0, $fechaPago = "", $montoPagado = 0.0,$idPropietario=0) {
        $this->idPago = $idPago;
        $this->idCuenta = $idCuenta;
        $this->fechaPago = $fechaPago;
        $this->montoPagado = $montoPagado;
        $this->idPropietario = $idPropietario;
    }

    public function insertarPago() {
        return "
        INSERT INTO pago (id_cuenta, fecha_pago, monto_pagado, id_propietario)
        VALUES ({$this->idCuenta}, '{$this->fechaPago}', {$this->montoPagado}, {$this->idPropietario})
        ";
    }

        public function consultarPorPropiedad($idPropietario, $numeroApartamento) {
            return "SELECT p.id_pago, p.id_cuenta, p.fecha_pago, p.monto_pagado
                FROM pago p
                JOIN cuenta_cobro cc ON p.id_cuenta = cc.id_cuenta
                JOIN apartamento a ON cc.numero_apartamento = a.numero
                WHERE a.id_propietario = {$idPropietario}
                  AND a.numero = {$numeroApartamento}";
        }
        
        public function consultarPagosPorPropietario($idPropietario) {
            return "SELECT p.id_pago, p.id_cuenta, p.fecha_pago, p.monto_pagado
                FROM pago p
                JOIN cuenta_cobro cc ON p.id_cuenta = cc.id_cuenta
                JOIN apartamento a ON cc.numero_apartamento = a.numero
                WHERE a.id_propietario = {$idPropietario}";
        }
    
}
?>
