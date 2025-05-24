<?php
require_once __DIR__ . "/../persistencia/CobroDAO.php";
require_once __DIR__ . "/../persistencia/conexion.php";
class CuentaCobro {
    private $id;
    private $numeroApartamento;
    private $estado;
    private $fechaGeneracion;
    private $valor;
    private $idAdministrador;

    public function __construct(
        $id = 0,
        $numeroApartamento = "",
        $estado = "",
        $fechaGeneracion = "",
        $valor = 0.00,
        $idAdministrador = 0
    ) {
        $this->id = $id;
        $this->numeroApartamento = $numeroApartamento;
        $this->estado = $estado;
        $this->fechaGeneracion = $fechaGeneracion;
        $this->valor = $valor;
        $this->idAdministrador = $idAdministrador;
    }

    public function getId() {
        return $this->id;
    }

    public function getNumeroApartamento() {
        return $this->numeroApartamento;
    }

    public function getEstado() {
        return $this->estado;
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

    public function pagar() {
        $conexion = new Conexion();
        $conexion->abrir();
        $conexion->ejecutar("update cuenta_cobro SET id_estado = 2 WHERE id_cuenta = " . $this->id);
        $conexion->cerrar();
    }

    public function consultarPorEstado($estadoId) {
        $conexion = new Conexion();
        $cuentaDAO = new CobroDAO();
        $conexion->abrir();

        $conexion->ejecutar($cuentaDAO->consultarCuentasPorEstado($estadoId));

        $cuentas = array();
        while (($datos = $conexion->registro()) != null) {
            $apartamento = new Apartamento($datos[1], $datos[2], $datos[3]); 
            $estado = new Estado(0, $datos[7]);
            $cuenta = new CuentaCobro(
                $datos[0],         
                $apartamento,      
                $estado,          
                $datos[5],        
                $datos[6],         
                $datos[4]          
            );

            array_push($cuentas, $cuenta);
        }

        $conexion->cerrar();
        return $cuentas;
    }


    public function consultarPorPropietario($idPropietario) {
    $conexion = new Conexion();
    $cuentaDAO = new CobroDAO();
    $conexion->abrir();

    $conexion->ejecutar($cuentaDAO->consultarCuentasPorPropietario($idPropietario));

    $cuentas = array();
    while (($datos = $conexion->registro()) != null) {
            $apartamento = new Apartamento($datos[1], $datos[2], $datos[3]); 
            $estado = new Estado(0, $datos[7]);
            $cuenta = new CuentaCobro(
                $datos[0],         
                $apartamento,      
                $estado,          
                $datos[5],        
                $datos[6],         
                $datos[4]          
            );

            array_push($cuentas, $cuenta);
        }

    $conexion->cerrar();
    return $cuentas;
    }
    
    public function tieneCuentas($numero) {
        $conexion = new Conexion();
        $cuentaDAO = new CobroDAO();
        $conexion->abrir();
        $conexion->ejecutar($cuentaDAO->tieneCuentas($numero));
        if($conexion->filas() > 0){
            $conexion->cerrar();
            return true;
        }else{
            $conexion->cerrar();
            return false;
        }
    }

    public function consultarPorApartamento($numeroApartamento) {
        $conexion = new Conexion();
        $cuentaDAO = new CobroDAO();
        $conexion->abrir();
        
        $conexion->ejecutar($cuentaDAO->consultarCuentasPorApartamento($numeroApartamento));
        
        $cuentas = array();
        while (($datos = $conexion->registro()) != null) {
            $apartamento = new Apartamento($datos[1], null, null); // sólo número, el resto puede ir null si no lo usas
            $estado = new Estado(0, $datos[7]);
            $cuenta = new CuentaCobro(
                $datos[0],           // id
                $apartamento,        // númeroApartamento como objeto Apartamento
                $estado,             // estado
                $datos[5],           // fechaGeneracion
                $datos[6],           // valor
                $datos[2]            // idAdministrador (aquí es idPropietario, revisa según tu modelo)
                );
            
            array_push($cuentas, $cuenta);
        }
        
        $conexion->cerrar();
        return $cuentas;
    }
    

}

?>