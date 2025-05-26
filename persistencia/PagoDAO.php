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
            return "SELECT p.id_pago, p.id_cuenta, p.fecha_pago, p.monto_pagado, a.numero
                FROM pago p
                JOIN cuenta_cobro cc ON p.id_cuenta = cc.id_cuenta
                JOIN apartamento a ON cc.numero_apartamento = a.numero
                WHERE a.id_propietario = {$idPropietario}";
        }
    
        public function consultarPagoTotal($numero){
            return"SELECT 
                COALESCE(SUM(p.monto_pagado), 0) AS total_pagos
                FROM 
                    pago p
                WHERE 
                    p.id_cuenta IN (
                        SELECT cc.id_cuenta
                        FROM cuenta_cobro cc
                        WHERE cc.numero_apartamento = {$numero}
                )";
        }
        
        public function consultarPagoEspecifico($numero,$idCuenta){
            return"		SELECT
					    SUM(p.monto_pagado) AS total_pagado
					FROM
					    pago p
					JOIN
					    cuenta_cobro cc ON p.id_cuenta = cc.id_cuenta
					WHERE
					    cc.numero_apartamento = {$numero} AND p.id_cuenta = {$idCuenta}";
        }
}
?>
