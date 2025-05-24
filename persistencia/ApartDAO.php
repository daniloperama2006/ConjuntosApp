<?php
class ApartDAO {
    private $numero;
    private $id_propietario;
    private $created_at;
    
    public function __construct($numero = "", $id_propietario = "", $created_at = "") {
        $this->numero = $numero;
        $this->id_propietario = $id_propietario;
        $this->created_at = $created_at;
    }
    
    public function consultarPorNumero() {
        return "SELECT numero, id_propietario, created_at
                FROM apartamento
                WHERE numero = '{$this->numero}'";
    }
    
    public function insertar() {
        return "INSERT INTO apartamento (numero, id_propietario)
                VALUES ('{$this->numero}', {$this->id_propietario})";
    }
    
    public function actualizar($nuevoNumero, $nuevoPropietario) {
        return "UPDATE apartamento
                SET numero = '{$nuevoNumero}', id_propietario = {$nuevoPropietario}
                WHERE numero = '{$this->numero}' AND id_propietario = {$this->id_propietario}";
    }
    
    public function eliminar() {
        return "DELETE FROM apartamento
                WHERE numero = '{$this->numero}' AND id_propietario = {$this->id_propietario}";
    }
    
    public function consultarTodos() {
        return "SELECT a.numero, a.id_propietario, p.nombre, p.apellido, a.created_at
                FROM apartamento a
                JOIN propietario p ON a.id_propietario = p.id";
    }
}
?>
