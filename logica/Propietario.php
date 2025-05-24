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
        if ($datos != null) {
            $this->nombre = $datos[0];
            $this->apellido = $datos[1];
            $this->correo = $datos[2];
        }
        else{
            $this->nombre = null;
            $this->apellido = null;
            $this->correo = null;
        }
        $conexion->cerrar();
    }
    
    public function consultarInformacion() {
        $dao = new PropietarioDAO($this->id);
        $conexion = new Conexion();
        $conexion->abrir();
        $resultado = $conexion->ejecutar($dao->consultarInformacion());
        $registro = $conexion->registro($resultado);
        $conexion->cerrar();
        
        if ($registro) {
            $this->nombre = $registro[1];
            $this->apellido = $registro[2];
            $this->correo = $registro[3];
            return true;
        } else {
            return false;
        }
    }
    
    
    public function consultarNombre() {
        $conexion = new Conexion();
        $dao = new PropietarioDAO($this->id);
        $conexion->abrir();
        $conexion->ejecutar($dao->consultar());
        $datos = $conexion->registro();
        $this->nombre = $datos[0];
        $this->apellido = $datos[1];
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
    
    public function contarApartamentos() {
        $conexion = new Conexion();
        $dao = new PropietarioDAO($this->id);
        $conexion->abrir();
        $resultado = $conexion->ejecutar($dao->tieneApartamentos()); 
        $fila = $conexion->registro();  
        $conexion->cerrar();
        return (int)$fila[0];
    }
    
    public function existeCorreo($correo) {
        $conexion = new Conexion();
        $dao = new PropietarioDAO();
        $conexion->abrir();
        $sql = $dao->consultarPorCorreo($correo);
        $conexion->ejecutar($sql);
        $datos = $conexion->registro();
        $conexion->cerrar();
        return ($datos != null);
    }
    
    
    
}
?>
