<?php
class ApartDAO {
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
    
    public function consultarPorNumero() {
        return "SELECT id_apartamento, numero, id_propietario, created_at
                FROM apartamento
                WHERE numero = '{$this->numero}'";
    }
    
    public function insertar() {
        return "INSERT INTO apartamento (numero, id_propietario)
                VALUES ('{$this->numero}', {$this->id_propietario})";
    }
    
    public function actualizar() {
        return "UPDATE apartamento
                SET numero = '{$this->numero}', id_propietario = {$this->id_propietario}
                WHERE id_apartamento = {$this->idApartamento}";
    }
    
    public function eliminar() {
        return "DELETE FROM apartamento WHERE id_apartamento = {$this->idApartamento}";
    }
    
    public function consultarTodos() {
        return "SELECT a.id_apartamento,p.id, a.numero, p.nombre, p.apellido, a.created_at
                FROM apartamento a
                JOIN propietario p ON a.id_propietario = p.id";
    }
}
?>
