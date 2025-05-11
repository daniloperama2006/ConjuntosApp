<?php 
class CobroDAO{
    private $idCuentaCobro;
    private $idApartamento;
    private $idEstado;
    private $fechaGeneracion;
    private $valor;
    private $idAdministrador;

    public function __construct($idCuentaCobro = 0, $idApartamento = 0, $idEstado = 0,$fechaGeneracion = "", $valor = 0.0, $idAdministrador = 0) {
        $this -> idCuentaCobro = $idCuentaCobro;
        $this -> idApartamento = $idApartamento;
        $this -> idEstado = $idEstado;
        $this -> fechaGeneracion = $fechaGeneracion;
        $this -> valor = $valor;
        $this -> idAdministrador = $idAdministrador;
    }

    public function insertarCuentaCobro(){
        return "
        insert into Cuenta_cobro
        (id_apartamento, id_estado, fecha_generacion, valor, id_administrador)
        VALUES ({$this->idApartamento}, {$this->idEstado}, '{$this->fechaGeneracion}', {$this->valor}, {$this->idAdministrador})
        ";
    }

    public function cambiarEstadoCuenta($idCuenta, $nuevoEstado) {
        return "update Cuenta_cobro SET id_estado = {$nuevoEstado} WHERE id_cuenta = {$idCuenta}";
    }

    public function consultarCuentasPorEstado($idEstado){
        return "
        SELECT
            cc.id_cuenta, a.numero AS numero_apartamento, u.id_usuario, u.nombre AS nombre_propietario,
            u.apellido AS apellido_propietario, cc.fecha_generacion, cc.valor,
            e.nombre_estado AS estado_cuenta
        FROM
            Cuenta_cobro cc JOIN Apartamento a ON cc.id_apartamento = a.id_apartamento
                            JOIN Usuario u ON a.id_propietario = u.id_usuario
                            JOIN Estado e ON cc.id_estado = e.id_estado
        WHERE 
            e.id_estado = " . $idEstado . " 
        ORDER BY
            u.apellido, u.nombre, a.numero;
        ";
    }

    public function consultarCuentasPorPropietario($idPropietario){
        return "
        SELECT
            cc.id_cuenta, a.numero AS numero_apartamento, u.id_usuario, u.nombre AS nombre_propietario,
            u.apellido AS apellido_propietario, cc.fecha_generacion, cc.valor,
            e.nombre_estado AS estado_cuenta
        FROM
            Cuenta_cobro cc JOIN Apartamento a ON cc.id_apartamento = a.id_apartamento
                            JOIN Usuario u ON a.id_propietario = u.id_usuario
                            JOIN Estado e ON cc.id_estado = e.id_estado
        WHERE 
            u.id_usuario = " . $idPropietario . "
        ORDER BY
            u.apellido, u.nombre, a.numero;
        ";
    }
}
?>