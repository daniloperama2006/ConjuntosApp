<?php
class CobroDAO {
    private $idCuentaCobro;
    private $numero;
    private $idEstado;
    private $fechaGeneracion;
    private $valor;
    private $idAdministrador;
    
    public function __construct($idCuentaCobro = 0, $numero = 0, $idEstado = 0, $fechaGeneracion = "", $valor = 0.0, $idAdministrador = 0) {
        $this->idCuentaCobro = $idCuentaCobro;
        $this->numero = $numero;
        $this->idEstado = $idEstado;
        $this->fechaGeneracion = $fechaGeneracion;
        $this->valor = $valor;
        $this->idAdministrador = $idAdministrador;
    }
    
    public function insertarCuentaCobro() {
        return "
            INSERT INTO cuenta_cobro (numero_apartamento, id_estado, fecha_generacion, valor, id_admin)
            VALUES ({$this->numero}, {$this->idEstado}, '{$this->fechaGeneracion}', {$this->valor}, {$this->idAdministrador})
        ";
    }
    
    
    public function cambiarEstadoCuenta($idCuenta, $nuevoEstado) {
        return "
            UPDATE cuenta_cobro
            SET id_estado = {$nuevoEstado}
            WHERE id_cuenta = {$idCuenta}
        ";
    }
    
    public function consultarCuentasPorEstado($idEstado) {
        return "
            SELECT
                cc.id_cuenta, a.numero, u.id, u.nombre AS nombre_propietario,
                u.apellido AS apellido_propietario, cc.fecha_generacion, cc.valor,
                e.nombre_estado AS estado_cuenta
            FROM
                cuenta_cobro cc
                JOIN apartamento a ON cc.numero_apartamento = a.numero
                JOIN propietario u ON a.id_propietario = u.id
                JOIN estado e ON cc.id_estado = e.id_estado
            WHERE
                e.id_estado = {$idEstado}
            ORDER BY
                u.apellido, u.nombre, a.numero
        ";
    }
    
    public function consultarCuentasPorPropietario($idPropietario) {
        return "
        SELECT
            cc.id_cuenta,
            cc.numero_apartamento,
            p.id AS id_propietario,
            p.nombre AS nombre_propietario,
            p.apellido AS apellido_propietario,
            cc.fecha_generacion,
            cc.valor,
            e.nombre_estado AS estado_cuenta
        FROM
            cuenta_cobro cc
            JOIN apartamento a ON cc.numero_apartamento = a.numero
            JOIN propietario p ON a.id_propietario = p.id
            JOIN estado e ON cc.id_estado = e.id_estado
        WHERE
            p.id = {$idPropietario}
        ORDER BY
            p.apellido, p.nombre, cc.numero_apartamento
    ";
    }
    
    public function tieneCuentas($numero) {
        return "
        SELECT
            cc.id_cuenta
        FROM
            cuenta_cobro cc
            JOIN apartamento a ON cc.numero_apartamento = a.numero
        WHERE
        	a.numero = {$numero}
    ";
    }
    
    
}
?>
