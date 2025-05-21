<?php
require_once("persistencia/Conexion.php");
require_once("persistencia/ApartDAO.php");
class Apartamento {
    private $idApartamento;
    private $numero;
    private $propietario;
    
    public function __construct($idApartamento = 0,$numero = 0,$bloque = 0,$propietario = 0) {
        $this->idApartamento = $idApartamento;
        $this->numero= $numero;
        $this->propietario = $propietario;
    }
    
    public function getIdApartamento(){
        return $this->idApartamento;
    }
    
    public function getNumero(){
        return $this->numero;
    }
    
    public function getPropietario(){
        return $this->propietario;
    }
    
    
    public function consultarPorNumero() {
        require_once 'persistencia/Conexion.php';
        require_once 'persistencia/ApartDAO.php';
        
        $dao = new ApartDAO(0, $this->numero);
        $conexion = new Conexion();
        $conexion->abrir();
        $resultado = $conexion->ejecutar($dao->consultarPorNumero());
        
        if ($registro = $conexion->registro($resultado)) {
            $this->idApartamento = $registro[0];
            $this->numero = $registro[1];
            $this->propietario = $registro[2];
            $conexion->cerrar();
            return true;
        } else {
            $conexion->cerrar();
            return false;
        }
    }
    
    public function insertar() {
        $dao = new ApartDAO(0, $this->numero, 0, $this->propietario);
        $conexion = new Conexion();
        $conexion->abrir();
        $conexion->ejecutar($dao->insertar());
        $conexion->cerrar();
    }
    
    public function actualizar() {
        $dao = new ApartDAO($this->idApartamento, $this->numero, 0, $this->propietario);
        $conexion = new Conexion();
        $conexion->abrir();
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
        $conexion->ejecutar($dao->consultarTodos());
        $res = [];
        while ($fila = $conexion->registro()) {
            $res[] = $fila;
        }
        $conexion->cerrar();
        return $res;
    }
    
    
}