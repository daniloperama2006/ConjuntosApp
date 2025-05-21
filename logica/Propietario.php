<?php
require_once("persistencia/Conexion.php");
require_once("persistencia/PropietarioDAO.php");
require_once("logica/Persona.php");

class Propietario extends Persona {
    
    public function __construct($id = "", $nombre = "", $apellido = "", $correo = "", $clave = "") {
        parent::__construct($id, $nombre, $apellido, $correo, $clave);
    }
    
    public function insertar() {
        $conexion = new Conexion();
        $dao = new PropietarioDAO(0, $this->nombre, $this->apellido, $this->correo, $this->clave);
        $conexion->abrir();
        $conexion->ejecutar($dao->insertar());
        $conexion->cerrar();
    }
    
    public function consultar() {
        $conexion = new Conexion();
        $dao = new PropietarioDAO($this->id);
        $conexion->abrir();
        $conexion->ejecutar($dao->consultar());
        $datos = $conexion->registro();
        $this->nombre = $datos[0];
        $this->apellido = $datos[1];
        $this->correo = $datos[2];
        $conexion->cerrar();
    }
    
    public function consultarTodos() {
        $conexion = new Conexion();
        $dao = new PropietarioDAO();
        $conexion->abrir();
        $conexion->ejecutar($dao->consultarTodos());
        $resultados = [];
        while ($registro = $conexion->registro()) {
            $resultados[] = $registro;
        }
        $conexion->cerrar();
        return $resultados;
    }
    
    public function actualizar() {
        $conexion = new Conexion();
        $dao = new PropietarioDAO($this->id, $this->nombre, $this->apellido, $this->correo);
        $conexion->abrir();
        $conexion->ejecutar($dao->actualizar());
        $conexion->cerrar();
    }
    
    public function eliminar() {
        $conexion = new Conexion();
        $dao = new PropietarioDAO($this->id);
        $conexion->abrir();
        $conexion->ejecutar($dao->eliminar());
        $conexion->cerrar();
    }
    
    public function autenticar() {
        $conexion = new Conexion();
        $dao = new PropietarioDAO(0, "", "", $this->correo, $this->clave);
        $conexion->abrir();
        $conexion->ejecutar($dao->autenticar());
        if ($conexion->filas() == 1) {
            $this->id = $conexion->registro()[0];
            $conexion->cerrar();
            return true;
        } else {
            $conexion->cerrar();
            return false;
        }
    }
}
?>
