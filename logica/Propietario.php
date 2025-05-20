<?php
require ("persistencia/PropietarioDAO.php");
require_once __DIR__ . "/../persistencia/Conexion.php";
require ("logica/Persona.php");
class Propietario extends Persona{
    

    public function __construct($id = "", $nombre = "", $apellido = "", $correo = "", $clave = ""){
        parent::__construct($id, $nombre, $apellido, $correo, $clave);
    }

    public function autenticar(){
        $conexion = new Conexion();
        $PropietarioDAO = new PropietarioDAO("","","", $this -> correo, $this -> clave);
        $conexion -> abrir();
        $conexion -> ejecutar($PropietarioDAO -> autenticar());
        if($conexion -> filas() == 1){            
            $resultado = $conexion -> registro();
            $id = $resultado[0];
            $conexion->cerrar();
            return true;
        }else{
            $conexion->cerrar();
            return false;
        }
    }

    public function consultar(){
        $conexion = new Conexion();
        $PropietarioDAO = new PropietarioDAO($this -> id);
        $conexion -> abrir();
        $conexion -> ejecutar($PropietarioDAO -> consultar());
        $datos = $conexion -> registro();
        $this -> nombre = $datos[0];
        $this -> apellido = $datos[1];
        $this -> correo = $datos[2];
        $conexion->cerrar();
    }

}

?>