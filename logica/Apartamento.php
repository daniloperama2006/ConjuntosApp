<?php
require_once("persistencia/Conexion.php");
require_once("persistencia/ApartDAO.php");

class Apartamento {
    private $idApartamento;
    private $numero;
    private $id_propietario;
    private $created_at;
    
    public function __construct($idApartamento = "", $numero = "", $id_propietario = "", $created_at = "") {
        $this->idApartamento = $idApartamento;
        $this->numero = $numero;
        $this->id_propietario = $id_propietario;
        $this->created_at = $created_at;
    }
    
    public function getIdApartamento() {
        return $this->idApartamento;
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
        $dao = new ApartDAO(0, $this->numero);
        $conexion = new Conexion();
        $conexion->abrir();
        $resultado = $conexion->ejecutar($dao->consultarPorNumero());
        
        $apartamentos = [];
        
        while ($registro = $conexion->registro($resultado)) {
            $apartamentos[] = [
                "idApartamento" => $registro[0],
                "numero" => $registro[1],
                "id_propietario" => $registro[2],
                "created_at" => $registro[3]
            ];
        }
        
        $conexion->cerrar();
        return $apartamentos;
    }
    
    public function insertar() {
        $dao = new ApartDAO(0, $this->numero, $this->id_propietario);
        $conexion = new Conexion();
        $conexion->abrir();
        $conexion->ejecutar($dao->insertar());
        $conexion->cerrar();
    }
    
    public function actualizar() {
        $conexion = new Conexion();
        $conexion->abrir();
        
        // Validar propietario antes de actualizar
        $validarPropietario = $conexion->ejecutar("SELECT id FROM propietario WHERE id = {$this->id_propietario}");
        if (!$conexion->registro($validarPropietario)) {
            $conexion->cerrar();
            throw new Exception("Error: El propietario con ID {$this->id_propietario} no existe.");
        }
        
        $dao = new ApartDAO($this->idApartamento, $this->numero, $this->id_propietario);
        $conexion->ejecutar($dao->actualizar());
        $conexion->cerrar();
    }
    
    public function eliminar() {
        $dao = new ApartDAO($this->idApartamento);
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
}
?>
