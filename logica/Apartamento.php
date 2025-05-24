<?php
require_once("persistencia/Conexion.php");
require_once("persistencia/ApartDAO.php");

class Apartamento {
    private $numero;
    private $idPropietario;
    private $created_at;
    
    public function __construct($numero = "", $idPropietario = "", $created_at = "") {
        $this->numero = $numero;
        $this->idPropietario = $idPropietario;
        $this->created_at = $created_at;
    }
    
    public function getNumero() {
        return $this->numero;
    }
    
    public function getId_propietario() {
        return $this->id_propietario;
    }
    
    public function getCreated_at() {
        return $this->created_at;
    }
    
    public function consultarPorNumero() {
        $dao = new ApartDAO($this->numero);
        $conexion = new Conexion();
        $conexion->abrir();
        $resultado = $conexion->ejecutar($dao->consultarPorNumero());
        
        $apartamentos = [];
        
        while ($registro = $conexion->registro($resultado)) {
            $apartamentos[] = [
                "numero" => $registro[0],
                "id_propietario" => $registro[1],
                "created_at" => $registro[2]
            ];
        }
        
        $conexion->cerrar();
        return $apartamentos;
    }
    
    public function insertar() {
        $dao = new ApartDAO($this->numero, $this->idPropietario);
        $conexion = new Conexion();
        $conexion->abrir();
        $conexion->ejecutar($dao->insertar());
        $conexion->cerrar();
    }
    
    public function actualizar($nuevoNumero, $nuevoPropietario) {
        $conexion = new Conexion();
        $conexion->abrir();
        
        // Validar propietario antes de actualizar
        $validarPropietario = $conexion->ejecutar("SELECT id FROM propietario WHERE id = {$nuevoPropietario}");
        if (!$conexion->registro($validarPropietario)) {
            $conexion->cerrar();
            throw new Exception("Error: El propietario con ID {$nuevoPropietario} no existe.");
        }
        
        $dao = new ApartDAO($this->numero, $this->idPropietario);
        $conexion->ejecutar($dao->actualizar($nuevoNumero, $nuevoPropietario));
        $conexion->cerrar();
    }
    
    public function eliminar() {
        $dao = new ApartDAO($this->numero, $this->idPropietario);
        $conexion = new Conexion();
        $conexion->abrir();
        $conexion->ejecutar($dao->eliminar());
        $conexion->cerrar();
    }
    
    public function consultarTodos() {
        $dao = new ApartDAO();
        $conexion = new Conexion();
        $conexion->abrir();
        $resultado = $conexion->ejecutar($dao->consultarTodos());
        
        $apartamentos = [];
        while ($registro = $conexion->registro($resultado)) {
            $apartamentos[] = $registro;
        }
        
        $conexion->cerrar();
        return $apartamentos;
    }
    
    public function consultarApartamentoPorPropietario() {
        $dao = new ApartDAO($this->numero, $this->idPropietario);
        $conexion = new Conexion();
        $conexion->abrir();
        $resultado = $conexion->ejecutar($dao->consultarPorNumeroYPropietario());
        $apartamentos = [];
        while ($registro = $conexion->registro($resultado)) {
            $apartamentos[] = [
                "numero" => $registro[0],
                "created_at" => $registro[1]
            ];
        }
        $conexion->cerrar();
        return $apartamentos;
    }
    
    public function consultarTodosPorPropietario() {
        $dao = new ApartDAO(null, $this->idPropietario);
        $conexion = new Conexion();
        $conexion->abrir();
        $resultado = $conexion->ejecutar($dao->consultarTodosPorPropietario());
        $apartamentos = [];
        while ($registro = $conexion->registro($resultado)) {
            $apartamentos[] = [
                "numero" => $registro[0],
                "created_at" => $registro[1]
            ];
        }
        $conexion->cerrar();
        return $apartamentos;
    }
    
}
?>
