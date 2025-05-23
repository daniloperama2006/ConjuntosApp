<?php 
class PagoDAO {
    private $idPago;
    private $idCuenta;
    private $fechaPago;
    private $montoPagado;

    public function __construct($idPago = 0, $idCuenta = 0, $fechaPago = "", $montoPagado = 0.0) {
        $this->idPago = $idPago;
        $this->idCuenta = $idCuenta;
        $this->fechaPago = $fechaPago;
        $this->montoPagado = $montoPagado;
    }

    // Insertar un nuevo pago
    public function insertarPago() {
        return "
        INSERT INTO pago (id_cuenta, fecha_pago, monto_pagado)
        VALUES ({$this->idCuenta}, '{$this->fechaPago}', {$this->montoPagado})
        ";
    }
    

    // Consultar pagos por cuenta (útil para propietario o admin)
    public function consultarPagosPorCuenta() {
        return "
        SELECT 
            p.id_pago, p.id_cuenta, p.fecha_pago, p.monto_pagado,
            u.nombre AS nombre_propietario, u.apellido, a.numero AS numero_apartamento
        FROM 
            pago p JOIN cuenta_cobro cc ON p.id_cuenta = cc.id_cuenta
                   JOIN apartamento a ON cc.id_apartamento = a.id_apartamento
                   JOIN usuario u ON a.id_propietario = u.id_usuario
        WHERE 
            p.id_cuenta = {$this->idCuenta}
        ";
    }

    // Opción adicional: consultar todos los pagos hechos por un usuario
    public function consultarPagosPorUsuario($idUsuario) {
        return "
        SELECT 
            p.id_pago, p.id_cuenta, p.fecha_pago, p.monto_pagado,
            cc.valor, e.nombre_estado, a.numero AS numero_apartamento
        FROM 
            pago p JOIN cuenta_cobro cc ON p.id_cuenta = cc.id_cuenta
                   JOIN apartamento a ON cc.id_apartamento = a.id_apartamento
                   JOIN usuario u ON a.id_propietario = u.id_usuario
                   JOIN estado e ON cc.id_estado = e.id_estado
        WHERE 
            u.id_usuario = {$idUsuario}
        ";
    }
}
?>
